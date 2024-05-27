<?php

namespace App\Http\Controllers;

use App\Models\Predictions;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PredictionController extends Controller
{
    
    public function index()
    {
        return view('pages.user-pages.scan');
    }

    // Validasi request
    public function predict(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Mengharuskan file gambar dengan format jpeg, png, jpg, atau gif dan maksimal ukuran 2MB
            'user_id' => 'required'
        ], [
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar yang didukung hanya jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
            'image.required' => 'Harap unggah sebuah gambar.',
            'user_id.required' => 'ID Pengguna harus diisi.'
        ]);


        // Ambil gambar yang diunggah
        $image = $request->file('image');
        $userId = $request->input('user_id');

        if ($image && $image->isValid()) {
            $client = new Client();
            try {
                $client->post('http://127.0.0.1:5000/predict', [
                    'multipart' => [
                        [
                            'name' => 'user_id',
                            'contents' => $userId
                        ],
                        [
                            'name' => 'image',
                            'contents' => file_get_contents($image->path()),
                            'filename' => $image->getClientOriginalName(),
                        ],
                    ],
                ]);

                $prediction = Predictions::where('user_id', $userId)->latest('id')->first();

                return view('pages.user-pages.hasil-scan',  [
                    'prediction' => $prediction, 
                    'img_url' => $prediction->img_url, 
                    'penyakit' => $prediction->penyakit, 
                    'deskripsi' => $prediction->deskripsi, 
                    'solusi' => $prediction->solusi, ]);
                
            }catch (\Exception $e) {
                return redirect()->route('scan')->with('error', $e->getMessage());
                // return view('pages.user-pages.scan', ['error' => $e-> getMessage()]);
            }
        }
        return redirect()->route('scan')->with('error', 'File Tidak Valid');
        // return view('pages.user-pages.scan', ['error' => 'invalid image file']);
        // return view('pages.user-pages.scan')->withErrors(['error' => $e->getMessage()]);
    }

}
