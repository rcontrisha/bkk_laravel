<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
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
        $lowongans = Lowongan::all();
        
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'gaji' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'requirement' => 'required|array|min:1', // Memastikan requirement adalah array dan tidak kosong
            'requirement.*' => 'string|max:255' // Setiap item dalam requirement adalah string
        ]);

        // Membuat lowongan baru
        $lowongan = Lowongan::create($request->only([
            'judul', 
            'perusahaan', 
            'lokasi', 
            'kategori', 
            'tipe', 
            'gaji', 
            'deskripsi'
        ]));

        // Menyimpan requirement terpisah jika perlu
        $lowongan->requirement = $request->input('requirement');
        $lowongan->save();

        // Mengembalikan response JSON
        return response()->json($lowongan, 201);
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
        ]);

        // Hanya memperbarui field yang ada dalam input
        $filteredData = array_filter($validated, function ($value) {
            return !is_null($value);
        });

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
