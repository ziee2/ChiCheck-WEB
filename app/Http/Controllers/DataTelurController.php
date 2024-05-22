<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataTelur;


class DataTelurController extends Controller
{

    public function index()
    {
        try {
            if (auth()->check()) {
                $user_id = auth()->id();
                $data['getAlldataTelur'] = DataTelur::where('user_id', $user_id)->get();
    
                if ($data['getAlldataTelur']->isEmpty()) {
                    $data['isEmpty'] = true;
                }
    
                return view('pages.user-pages.data-telur', $data);
            } else {
                return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }

        // try {
        //     $data['getAlldataTelur'] = DataTelur::all();
        //     if ($data['getAlldataTelur']->isEmpty()) {
        //         $data['isEmpty'] = true;
        //     }
        //     return view('pages.user-pages.data-telur', $data);
        //     } catch (\Exception $e) {
        //     return redirect()->back()->withErrors('error', 'Terjadi kesalahan: ' . $e->getMessage());
        //     }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'stok_telur' => 'required|numeric|min:1',
            'user_id' => 'required',
        ]);

        try {
            $telur = DataTelur::findOrFail($id);
            $telur->update([
                'stok_telur' => $request->stok_telur,
                'user_id' => $request->user_id,
            ]);

            return redirect()->back()->with('status', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tambahtelur(Request $request)
    {
        $request->validate([
            'stok_telur' => 'required|numeric|min:1',
            'user_id' => 'required',
        ],
        [
            'stok_telur.required' => 'Stok telur Harus diisi.',
            'stok_telur.numeric' => 'Stok telur Harus Berisi Angka.',
            'user_id.required' => 'ID Pengguna harus diisi.',
        ]);

        try {
            DataTelur::create($request->all());
            return redirect()->back()->with('status', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

        // Menghapus stok telur
    // public function hapusStok($id)
    // {
    //     try {
    //         $telur = DataTelur::findOrFail($id);
    //         $telur->delete();

    //         return redirect()->back()->with('status', 'Stok berhasil dihapus');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }

}


