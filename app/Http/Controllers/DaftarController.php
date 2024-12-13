<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DaftarLowongan;
use Illuminate\Http\Request;

class DaftarController extends Controller
{
    public function index()
    {
        // Ambil ID mitra yang sedang login
        $mitraId = auth()->user()->id;

        // Filter pendaftaran berdasarkan mitra yang sedang login
        $pendaftaranLowongans = DaftarLowongan::with('lowongan', 'user')
            ->whereHas('lowongan', function ($query) use ($mitraId) {
                $query->where('id_mitra', $mitraId);
            })->get();

        // Cek apakah request berupa JSON
        if (request()->wantsJson()) {
            return response()->json(['data' => $pendaftaranLowongans], 200, ['Content-Type' => 'application/json']);
        } else {
            return view('pendaftaran.index', compact('pendaftaranLowongans'));
        }
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'lowongan_id' => 'required|exists:lowongan,id', // Pastikan ID lowongan valid
            'user_id' => 'required|exists:users,id',        // Pastikan ID user valid
            'status' => 'nullable|string|in:pending,accepted,rejected', // Status valid
            'lokasi_interview' => 'nullable|string|max:255', // Opsional
            'tanggal_interview' => 'nullable|date|after_or_equal:today', // Opsional, tanggal harus di masa depan atau hari ini
        ]);

        // Buat pendaftaran baru
        $daftarLowongan = DaftarLowongan::create([
            'lowongan_id' => $validatedData['lowongan_id'],
            'user_id' => $validatedData['user_id']
        ]);

        return response()->json([
            'message' => 'Data pendaftaran berhasil ditambahkan.',
            'data' => $daftarLowongan,
        ], 201);
    }

    public function show($id)
    {
        $pendaftaran = DaftarLowongan::with('lowongan', 'user')->findOrFail($id);
        return response()->json($pendaftaran);
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = DaftarLowongan::findOrFail($id);

        // Validasi input jika status adalah 'accept'
        if ($request->status === 'accepted') {
            $request->validate([
                'lokasi_interview' => 'required|string|max:255',
                'tanggal_interview' => 'required|date|after_or_equal:today',
            ]);

            // Update data interview
            $pendaftaran->lokasi_interview = $request->lokasi_interview;
            $pendaftaran->tanggal_interview = $request->tanggal_interview;
        }

        // Update status lamaran
        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return response()->json([
            'message' => 'Status pendaftaran berhasil diperbarui.',
            'pendaftaran' => $pendaftaran,
        ]);
    }

    public function getUserApplications()
    {
        // Ambil ID user yang sedang login
        $userId = auth()->user()->id;

        // Ambil data pendaftaran berdasarkan user_id
        $pendaftaranLowongans = DaftarLowongan::with('lowongan', 'user')
            ->where('user_id', $userId) // Filter berdasarkan user_id yang sedang login
            ->get();

        // Cek apakah request berupa JSON
        return response()->json(['data' => $pendaftaranLowongans]);
    }
}
