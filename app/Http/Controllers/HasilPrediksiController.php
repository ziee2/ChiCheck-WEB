<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Predictions;

class HasilPrediksiController extends Controller
{
    private $param;
    public function index()
    {
        // Ambil data prediksi terbaru dari database

        try{
            $this->param['getDataTerbaru'] = Predictions::latest()->first();
            return view('pages.user-pages.hasil-prediksi', $this->param);

        } catch(\Exception $e){
            return redirect()->back()->withErrors('terjadi kesalahan : ', $e->getMessage());

        }catch(\Exception | \Illuminate\Database\QueryException $e){
                return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        } 
    }
}