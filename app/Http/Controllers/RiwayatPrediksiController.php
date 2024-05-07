<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Predictions;

class RiwayatPrediksiController extends Controller
{
    //
    private $param;
    public function index(){
        try{
            $this->param['getAllPredictions'] = Predictions::all();
            return view('pages.user-pages.riwayat-scan', $this->param);
        
        } catch(\Exception $e){
            return redirect()->back()->withErrors('terjadi kesalahan : ', $e->getMessage());

        }catch(\Exception | \Illuminate\Database\QueryException $e){
                return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
}
