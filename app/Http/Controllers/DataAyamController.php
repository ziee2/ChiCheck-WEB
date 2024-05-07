<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAyam;

class DataAyamController extends Controller
{
    public function index()
    {
        // Ambil data ayam terbaru
        $dataAyam = DataAyam::latest()->first();
        
        // Tampilkan view dengan data ayam terbaru
        return view('dataayam', compact('dataAyam'));
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'stok' => 'required|integer'
        ]);

        // Cek apakah sudah ada data ayam
        $existingAyam = DataAyam::first();
        if($existingAyam) {
            // Jika sudah ada, tambahkan stok yang baru
            $existingAyam->stok += $request->stok;
            $existingAyam->save();
        } else {
            // Jika belum ada, buat data baru
            DataAyam::create([
                'stok' => $request->stok
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('dataayam.index')->with('success','Stok ayam berhasil ditambahkan.');
    }

    public function update(Request $request, DataAyam $dataAyam)
    {
        // Validasi request
        $request->validate([
            'stok' => 'required|integer'
        ]);

        // Update stok ayam
        $dataAyam->update([
            'stok' => $request->stok
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('dataayam.index')->with('success','Stok ayam berhasil diupdate.');
    }
}
