<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAyam;
use App\Models\DataPakan;
use App\Models\DataTelur;
use Carbon\Carbon;

class DashboardController extends Controller
{
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

            return view('dashboard.index', compact('totalStokAyam', 'totalStokPakan', 'totalStokTelur', 'dailyEggData', 'monthlyEggData', 'notification'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function totalStokAyam($user_id)
    {
        try {
            $totalStokAyam = DataAyam::where('user_id', $user_id)->sum('stok_ayam');
            return $totalStokAyam;
        } catch (\Exception $e) {
            return 0; // Jika terjadi kesalahan, kembalikan 0 atau penanganan kesalahan sesuai kebutuhan.
        }
    }

    public function totalStokTelur($user_id)
    {
        try {
            $totalStokTelur = DataTelur::where('user_id', $user_id)->sum('stok_telur');
            return $totalStokTelur;
        } catch (\Exception $e) {
            return 0; // Jika terjadi kesalahan, kembalikan 0 atau penanganan kesalahan sesuai kebutuhan.
        }
    }

    public function totalStokPakan($user_id)
    {
        try {
            $totalStokPakan = DataPakan::where('user_id', $user_id)->sum('stok_pakan');
            return $totalStokPakan;
        } catch (\Exception $e) {
            return 0; // Jika terjadi kesalahan, kembalikan 0 atau penanganan kesalahan sesuai kebutuhan.
        }
    }

    public function dailyEggData($user_id)
    {
        try {
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();
            $dailyEggData = DataTelur::where('user_id', $user_id)
                                     ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                     ->get();

            $labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            $data = [];

            for ($i = 0; $i < 7; $i++) {
                $date = $startOfWeek->copy()->addDays($i)->format('Y-m-d');
                $count = $dailyEggData->filter(function ($item) use ($date) {
                    return Carbon::parse($item->created_at)->format('Y-m-d') == $date;
                })->sum('stok_telur');
                array_push($data, $count);
            }

            return ['labels' => $labels, 'data' => $data];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function monthlyEggData($user_id)
    {
        try {
            $currentYear = Carbon::now()->year;
            $monthlyEggData = DataTelur::where('user_id', $user_id)
                                       ->whereYear('created_at', $currentYear)
                                       ->get();

            $labels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $data = [];

            for ($i = 1; $i <= 12; $i++) {
                $count = $monthlyEggData->where('created_at', '>=', Carbon::create($currentYear, $i)->startOfMonth())
                                        ->where('created_at', '<=', Carbon::create($currentYear, $i)->endOfMonth())
                                        ->sum('stok_telur');
                array_push($data, $count);
            }

            return ['labels' => $labels, 'data' => $data];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function checkEggReduction($user_id)
    {
        try {
            $today = Carbon::now()->format('Y-m-d');
            $lastSevenDays = DataTelur::where('user_id', $user_id)
                                      ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))
                                      ->whereDate('created_at', '<=', $today)
                                      ->orderBy('created_at', 'asc')
                                      ->get()
                                      ->groupBy(function($date) {
                                          return Carbon::parse($date->created_at)->format('Y-m-d');
                                      });

            $dailyCounts = [];
            foreach ($lastSevenDays as $date => $records) {
                $dailyCounts[$date] = $records->sum('stok_telur');
            }

            $prevCount = null;
            foreach ($dailyCounts as $date => $count) {
                if ($prevCount !== null && $prevCount > 0) {
                    $dailyDrop = (($prevCount - $count) / $prevCount) * 100;
                    if ($dailyDrop >= 5) {
                        return "Produksi telur pada $date turun lebih dari 5% dibandingkan hari sebelumnya.";
                    }
                }
                $prevCount = $count;
            }

            $initialCount = reset($dailyCounts);
            $latestCount = end($dailyCounts);
            if ($initialCount > 0) {
                $cumulativeDrop = (($initialCount - $latestCount) / $initialCount) * 100;
                if ($cumulativeDrop >= 5) {
                    return "Jumlah telur dalam tujuh hari terakhir lebih rendah 5% dari hari pertama dalam periode tersebut.";
                }
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
