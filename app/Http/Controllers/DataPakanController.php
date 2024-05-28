<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pakan;

class DataPakanController extends Controller
{
    public function index()
    {
        try {
            if (auth()->check()) {
                $user_id = auth()->id();
                $data['getAlldataPakan'] = Pakan::where('user_id', $user_id)->get();
    
                if ($data['getAlldataPakan']->isEmpty()) {
                    $data['isEmpty'] = true;
                }
    
                return view('pages.user-pages.data-pakan', $data);
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
            'nama' => 'required|string|max:255',
            'stok_pakan' => 'required|numeric|min:1',
            'user_id' => 'required',
        ],
        [
            'nama.required' => 'nama Harus diisi.',
            'stok_pakan.required' => 'Harap mengisi stok terlebih dahulu',
            'stok_pakan.numeric' => 'Stok Pakan Harus Berisi Angka.',
            'user_id.required' => 'ID Pengguna harus diisi.',
        ]);

        try {
            $pakan = Pakan::findOrFail($id);
            $pakan->update([
                'nama' => $request->nama,
                'stok_pakan' => $request->stok_pakan,
                'user_id' => $request->user_id,
            ]);

            return redirect()->back()->with('status', 'Data berhasil dirubah');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tambahpakan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok_pakan' => 'required|numeric|min:1',
            'user_id' => 'required',
        ],
        [
            'nama.required' => 'nama Harus diisi.',
            'stok_pakan.required' => 'Harap mengisi stok terlebih dahulu.',
            'stok_pakan.numeric' => 'Stok Pakan Harus Berisi Angka.',
            'user_id.required' => 'ID Pengguna harus diisi.',
        ]);

        try {
            Pakan::create($request->all());
            return redirect()->back()->with('status', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

