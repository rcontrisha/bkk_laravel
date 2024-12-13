<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::all();

        if (request()->wantsJson()) {
            // Pastikan mengirim respons dengan JSON header
            return response()->json(['data' => $lowongans], 200, ['Content-Type' => 'application/json']);
        } else {
            return view('lowongan.input', compact('lowongans'));
        }
    }

    public function data()
    {
        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Fetch data lowongan berdasarkan id_mitra pengguna yang sedang login
        $lowongans = Lowongan::where('id_mitra', $user->id)->get();

        if (request()->wantsJson()) {
            return response()->json(['data' => $lowongans], 200);
        }

        return view('lowongan.show', compact('lowongans'));
    }

    // Menampilkan detail lowongan
    public function show($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return response()->json($lowongan);
    }

    // Menambahkan lowongan baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'gaji' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'requirement' => 'required|array|min:1',
            'requirement.*' => 'string|max:255',
            'link_lamaran' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:10240' // Validasi untuk file photo
        ]);

        // Simpan data lowongan
        $lowongan = new Lowongan();
        $lowongan->judul = $validated['judul'];
        $lowongan->id_mitra = auth()->id();
        $lowongan->perusahaan = $validated['perusahaan'];
        $lowongan->kategori = $validated['kategori'];
        $lowongan->tipe = $validated['tipe'];
        $lowongan->lokasi = $validated['lokasi'];
        $lowongan->gaji = $validated['gaji'];
        $lowongan->deskripsi = $validated['deskripsi'];
        $lowongan->link_lamaran = $validated['link_lamaran'];
        $lowongan->photo = $request->file('photo') 
        ? $request->file('photo')->move(public_path('uploads/lowongan'), $request->file('photo')->getClientOriginalName()) 
        : null;
    
        // Format requirement sebagai array string (langsung sebagai string array)
        $lowongan->requirement = '[' . implode(', ', array_map(function ($item) {
            return '"' . addslashes($item) . '"'; // Menambahkan tanda kutip ganda dan escape karakter
        }, $validated['requirement'])) . ']';

        $lowongan->save();

        // Mengembalikan response JSON atau notifikasi sukses
        return back()->with('success', 'Lowongan berhasil ditambahkan!');
    }

    // Mengupdate lowongan
    public function update(Request $request, $id)
    {
        // Dapatkan lowongan berdasarkan ID
        $lowongan = Lowongan::findOrFail($id);

        // Validasi data input yang diperbarui
        $validated = $request->validate([
            'judul' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'tipe' => 'nullable|string|max:255',
            'gaji' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'requirement' => 'nullable|array', // Validasi sebagai array
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:10240' // Validasi untuk file photo
        ]);

        // Hanya memperbarui field yang ada dalam input
        $filteredData = array_filter($validated, function ($value) {
            return !is_null($value);
        });

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $filteredData['photo'] = $photoPath;
        
            // Hapus file foto lama jika ada
            if ($lowongan->photo) {
                Storage::disk('public')->delete($lowongan->photo);
            }
        }

        // Mengubah requirement menjadi JSON string
        if (isset($filteredData['requirement'])) {
            $filteredData['requirement'] = json_encode($filteredData['requirement']);
        }

        // Perbarui data lowongan dengan field yang disaring
        $lowongan->update($filteredData);

        // Mengembalikan respons JSON
        return response()->json(['message' => 'Data lowongan berhasil diperbarui', 'data' => $lowongan], 200);
    }

    // Menghapus lowongan
    public function destroy($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();

        return response()->json(null, 204);
    }
}
