<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayam;

class DataAyamController extends Controller
{
    public function index()
    {

        try {
            if (auth()->check()) {
                $user_id = auth()->id();
                $data['getAlldataAyam'] = Ayam::where('user_id', $user_id)->get();
    
                if ($data['getAlldataAyam']->isEmpty()) {
                    $data['isEmpty'] = true;
                }
    
                return view('pages.user-pages.data-ayam', $data);
            } else {
                return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'kandang' => 'required|string|max:255',
            'stok_ayam' => 'required|numeric|min:1',
            'user_id' => 'required',
        ],
        [
            'kandang.required' => 'Kandang Harus diisi.',
            'stok_ayam.required' => 'Stok Ayam Harus diisi.',
            'stok_ayam.numeric' => 'Stok Ayam Harus Berisi Angka.',
            'user_id.required' => 'ID Pengguna harus diisi.',
        ]);

        try {
            $ayam = Ayam::findOrFail($id);
            $ayam->update([
                'kandang' => $request->kandang,
                'stok_ayam' => $request->stok_ayam,
                'user_id' => $request->user_id,
            ]);

            return redirect()->back()->with('status', 'Data berhasil dirubah');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error','Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tambahKandang(Request $request)
    {
        $request->validate([
            'kandang' => 'required|string|max:255',
            'stok_ayam' => 'required|numeric|min:1',
            'user_id' => 'required',
        ],
        [
            'kandang.required' => 'Kandang Harus diisi.',
            'stok_ayam.required' => 'Stok Ayam Harus diisi.',
            'stok_ayam.numeric' => 'Stok Ayam Harus Berisi Angka.',
            'user_id.required' => 'ID Pengguna harus diisi.',
        ]);

        try {
            Ayam::create($request->all());
            return redirect()->back()->with('status', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error','Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
