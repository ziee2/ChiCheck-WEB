<?php

namespace App\Http\Controllers;

use App\Models\report_models;
use App\Models\ReportModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class PredictionController extends Controller
{
    public function predict(Request $request)
    {
        // Ambil gambar yang diunggah
        $image = $request->file('image');
        $userId = $request->input('user_id');

        if ($image && $image->isValid()) 
            {
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
                
                $report = report_models::Where('user_id', $request->user()->id)->with("reportDisease.disease")->latest()->first();

                return view('scan', ['report' => $report]);
            }catch (\Exception $e) {
                return view('scan', ['error' => $e-> getMessage()]);
            }
        }
        return view('scan', ['error' => 'invalid image file']);
    }
}
