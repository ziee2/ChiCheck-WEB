<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller

{
    // public function index()
    // {
    //     return view('dashboard.admin.dashboard-admin');
    // }

    public function index()
    {   
        try {
            $user_id = auth()->id(); // Pastikan pengguna sudah login
            
            if (!$user_id) {
                return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
            }

            $totalStokAyam = $this->totalStokAyam($user_id);
            $totalStokPakan = $this->totalStokPakan($user_id);
            $totalStokTelur = $this->totalStokTelur($user_id);

            $dailyEggData = $this->dailyEggData($user_id);
            $monthlyEggData = $this->monthlyEggData($user_id);

            $notification = $this->checkEggReduction($user_id);

            return view('dashboard.admin.dashboard-admin', compact('totalStokAyam', 'totalStokPakan', 'totalStokTelur', 'dailyEggData', 'monthlyEggData', 'notification'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
