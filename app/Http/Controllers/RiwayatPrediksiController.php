<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Predictions;

class RiwayatPrediksiController extends Controller
{
    //
    // private $param;
    public function index()
    {
        // try {
        //     if (auth()->check()) {
        //         $user_id = auth()->id();
        //         $data['getAllPredictions'] = Predictions::where('user_id', $user_id)->get();
    
        //         if ($data['getAllPredictions']->isEmpty()) {
        //             $data['isEmpty'] = true;
        //         }
    
        //         return view('pages.user-pages.riwayat-scan', $data);
        //     } else {
        //         return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        //     }
        // } catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        // }

        try {
            if (auth()->check()) {
                $user_id = auth()->id();
                // Order by created_at in descending order to get the latest predictions first
                $data['getAllPredictions'] = Predictions::where('user_id', $user_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
    
                if ($data['getAllPredictions']->isEmpty()) {
                    $data['isEmpty'] = true;
                }
    
                return view('pages.user-pages.riwayat-scan', $data);
            } else {
                return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    


    }
}
