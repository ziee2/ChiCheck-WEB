<?php

namespace App\Http\Controllers;

use App\Models\diseases_model;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    public function index()
    {
        $diseases = diseases_model::all();
        return view('nama_view', compact('diseases'));
    }
    
}
