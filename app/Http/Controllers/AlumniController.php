<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni; // Asumsikan Anda sudah membuat model Alumni
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AlumniController extends Controller
{
    /**
     * Tampilkan daftar alumni untuk halaman web.
     */
    public function index()
    {
        $alumnis = Alumni::all();
        
        if (request()->wantsJson()) {
            return response()->json(['data' => $alumnis], 200);
        }

        return view('alumni.index', compact('alumnis'));
    }

    /**
     * Tampilkan detail alumni untuk halaman web.
     */
    public function show()
    {
        $user = Auth::user();

        // Log ID pengguna yang sedang login
        Log::info('User ID yang sedang login: ' . $user->id);

        $alumni = Alumni::with('user')->where('user_id', $user->id)->first();

        if (request()->wantsJson()) {
            // Mengembalikan data alumni dalam format JSON
            if (!$alumni) {
                return response()->json(['message' => 'Data alumni tidak ditemukan.'], 404);
            }

            return response()->json(['data' => $alumni], 200);
        }

        return view('alumni.show', compact('alumni'));
    }

    /**
     * Edit alumni data.
     */
    // Menampilkan form edit alumni
    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        return response()->json(['data' => $alumni]);
    }

    /**
     * Ambil semua data alumni untuk API.
     */
    public function getData()
    {
        $alumnis = Alumni::all();
        return response()->json(['data' => $alumnis], 200);
    }

    /**
     * Simpan data alumni baru.
     */
    public function store(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Periksa apakah user yang sedang login sudah memiliki data alumni jika bukan admin
        if ($user->role !== 'admin') {
            $existingAlumni = Alumni::where('user_id', $user->id)->first();
            
            if ($existingAlumni) {
                return response()->json(['message' => 'User ini sudah memiliki data alumni'], 400);
            }
        }

        // Validasi data
        $validated = $request->validate([
            'nisn' => 'required|numeric|unique:alumnis,nisn',
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'jurusan' => 'required|string|max:255',
            'tahun_kelulusan' => 'required|numeric|digits:4',
            'sasaran' => 'required|string|max:255',
            'tempat_sasaran' => 'nullable|string|max:255',
            'nomor_telepon' => 'required|numeric|digits_between:11,13',
            'email' => 'required|email|max:255|unique:alumnis,email',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048', // Validasi file CV
        ]);

        // Tambahkan ID user yang sedang login ke dalam data yang akan disimpan
        $validated['user_id'] = Auth::id();

        // Proses file CV jika ada
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = 'cv_' . time() . '_' . $file->getClientOriginalName(); // Nama unik untuk file
            $path = $file->storeAs('public/cv', $filename); // Simpan file ke storage/public/cv
            $validated['file_cv'] = $path; // Simpan path ke database
        }

        // Buat data alumni baru
        $alumni = Alumni::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Data berhasil disimpan',
                'data' => $alumni
            ], 201);
        }

        return redirect()->route('alumni.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Update data alumni yang ada.
     */
    public function update(Request $request, $id)
    {
        // Dapatkan alumni berdasarkan ID
        $alumni = Alumni::findOrFail($id);

        // Validasi data input yang diperbarui
        $validated = $request->validate([
            'nisn' => 'nullable|numeric|unique:alumnis,nisn,' . $alumni->id,
            'nama_siswa' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
            'jurusan' => 'nullable|string|max:255',
            'tahun_kelulusan' => 'nullable|numeric|digits:4',
            'sasaran' => 'nullable|string|max:255',
            'tempat_sasaran' => 'nullable|string|max:255',
            'nomor_telepon' => 'nullable|numeric|digits_between:11,13',
            'email' => 'nullable|email|max:255|unique:alumnis,email,' . $alumni->id
        ]);

        // Hanya memperbarui field yang ada dalam input
        $filteredData = array_filter($validated, function ($value) {
            return !is_null($value);
        });

        // Perbarui data alumni dengan field yang disaring
        $alumni->update($filteredData);

        // Mengembalikan respons JSON
        return response()->json(['message' => 'Data alumni berhasil diperbarui', 'data' => $alumni], 200);
    }

    /**
     * Hapus data alumni.
     */
    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        }

        return redirect()->route('alumni.index')->with('success', 'Data berhasil dihapus');
    }

    /**
     * Menampilkan halaman dashboard admin dengan rekapitulasi data alumni.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard(Request $request)
    {
        $tahun = $request->input('tahun');

        // Mengambil rekapitulasi alumni
        $rekapitulasi = Alumni::selectRaw('tahun_kelulusan, 
                COUNT(*) as total,
                SUM(CASE WHEN sasaran = "bekerja" THEN 1 ELSE 0 END) as bekerja,
                SUM(CASE WHEN sasaran = "kuliah" THEN 1 ELSE 0 END) as kuliah,
                SUM(CASE WHEN sasaran = "wirausaha" THEN 1 ELSE 0 END) as wirausaha,
                SUM(CASE WHEN sasaran = "belum kerja" THEN 1 ELSE 0 END) as belum_kerja,
                SUM(CASE WHEN sasaran = "belum terdata" THEN 1 ELSE 0 END) as belum_terdata')
            ->when($tahun && $tahun !== '--Tahun--', function($query) use ($tahun) {
                return $query->where('tahun_kelulusan', $tahun);
            })
            ->groupBy('tahun_kelulusan')
            ->get();

        // Data untuk grafik: status sebagai labels dan jumlah alumni per status sebagai counts
        $chartData = [
            'labels' => ['Bekerja', 'Kuliah', 'Wirausaha', 'Belum Kerja', 'Belum Terdata'],
            'counts' => [
                $rekapitulasi->sum('bekerja'),
                $rekapitulasi->sum('kuliah'),
                $rekapitulasi->sum('wirausaha'),
                $rekapitulasi->sum('belum_kerja'),
                $rekapitulasi->sum('belum_terdata'),
            ]
        ];

        // Jika permintaan AJAX
        if ($request->ajax()) {
            // Mengambil data kompetensi berdasarkan tahun
            $kompetensi = Alumni::selectRaw('jurusan as kompetensi_keahlian, COUNT(*) as jumlah_alumni')
                ->when($tahun && $tahun !== '--Tahun--', function($query) use ($tahun) {
                    return $query->where('tahun_kelulusan', $tahun);
                })
                ->groupBy('jurusan')
                ->get();

            // Logging data kompetensi
            Log::info('Data Kompetensi untuk Tahun: ' . $tahun, ['kompetensi' => $kompetensi]);

            // Rendering tampilan untuk rekapitulasi dan kompetensi
            $rekapHtml = view('partials.alumni_tabel', compact('rekapitulasi'))->render();
            $kompetensiHtml = view('partials.kompetensi_tabel', compact('kompetensi'))->render();
            
            Log::info('Chart Data:', $chartData);
            // Mengirim data untuk tabel dan grafik
            return response()->json([
                'rekapHtml' => $rekapHtml,
                'kompetensiHtml' => $kompetensiHtml,
                'rekap' => $chartData // Data grafik lulusan
            ]);
        }

        // Mengambil data tahun_kelulusan yang unik dan diurutkan secara ascending
        $tahunKelulusan = Alumni::select('tahun_kelulusan')->distinct()->orderBy('tahun_kelulusan', 'asc')->get();
        $kompetensi = Alumni::selectRaw('jurusan as kompetensi_keahlian, COUNT(*) as jumlah_alumni')
            ->groupBy('jurusan')
            ->get();
        $totalAlumni = Alumni::count();

        return view('home', compact('rekapitulasi', 'kompetensi', 'totalAlumni', 'tahunKelulusan', 'chartData'));
    }
    
    public function filterAlumni(Request $request)
    {
        $tahun = $request->input('tahun');
    
        // Filter data berdasarkan tahun
        $rekapitulasi = Alumni::selectRaw('tahun_kelulusan, 
            COUNT(*) as total,
            SUM(CASE WHEN sasaran = "bekerja" THEN 1 ELSE 0 END) as bekerja,
            SUM(CASE WHEN sasaran = "kuliah" THEN 1 ELSE 0 END) as kuliah,
            SUM(CASE WHEN sasaran = "wirausaha" THEN 1 ELSE 0 END) as wirausaha,
            SUM(CASE WHEN sasaran = "belum kerja" THEN 1 ELSE 0 END) as belum_kerja,
            SUM(CASE WHEN sasaran = "belum terdata" THEN 1 ELSE 0 END) as belum_terdata')
            ->where('tahun_kelulusan', $tahun)
            ->groupBy('tahun_kelulusan')
            ->get();
    
        return view('partials.alumni_tabel', compact('rekapitulasi'))->render();
    }

    public function dataByYear(Request $request)
    {
        $tahun = $request->get('tahun');

        if ($tahun) {
            // Ambil alumni berdasarkan tahun kelulusan
            $alumni = Alumni::where('tahun_kelulusan', $tahun)->get();
        } else {
            // Ambil semua alumni jika tidak ada tahun yang dipilih
            $alumni = Alumni::all();
        }

        // Kembalikan tampilan dengan data alumni
        return view('alumni.data-alumni-tahun', compact('alumni', 'tahun'));
    }

    public function updatePhoto(Request $request)
    {
        $user = Auth::user();
        $alumni = Alumni::where('user_id', $user->id)->first();

        if (!$alumni) {
            return response()->json(['message' => 'Data alumni tidak ditemukan.'], 404);
        }

        // Validasi input file gambar
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hapus foto lama jika ada
        if ($alumni->photo && file_exists(public_path('uploads/profile_photos/' . $alumni->photo))) {
            unlink(public_path('uploads/profile_photos/' . $alumni->photo));
        }

        // Upload foto baru
        $photoName = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/profile_photos'), $photoName);

        // Update field photo di database
        $alumni->update(['photo' => $photoName]);

        return response()->json(['message' => 'Foto profil berhasil diperbarui', 'photo_url' => url('uploads/profile_photos/' . $photoName)], 200);
    }
}