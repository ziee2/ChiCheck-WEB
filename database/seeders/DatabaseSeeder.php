<?php

namespace Database\Seeders;

use App\Models\diseases_model;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */


     public function run()
     {
         $provinsi1 = Provinsi::create(['nama' => 'Provinsi 1']);
         $provinsi2 = Provinsi::create(['nama' => 'Provinsi 2']);
         $provinsi3 = Provinsi::create(['nama' => 'Provinsi 3']);
 
         $kabupaten1 = Kabupaten::create(['nama' => 'Kabupaten 1', 'provinsi_id' => $provinsi1->id]);
         $kabupaten2 = Kabupaten::create(['nama' => 'Kabupaten 2', 'provinsi_id' => $provinsi2->id]);
         $kabupaten3 = Kabupaten::create(['nama' => 'Kabupaten 3', 'provinsi_id' => $provinsi3->id]);
 
         $kecamatan1 = Kecamatan::create(['nama' => 'Kecamatan 1', 'kabupaten_id' => $kabupaten1->id]);
         $kecamatan2 = Kecamatan::create(['nama' => 'Kecamatan 2', 'kabupaten_id' => $kabupaten2->id]);
         $kecamatan3 = Kecamatan::create(['nama' => 'Kecamatan 3', 'kabupaten_id' => $kabupaten3->id]);
         
         Desa::create(['nama' => 'Desa 1', 'kecamatan_id' => $kecamatan1->id]);
         Desa::create(['nama' => 'Desa 2', 'kecamatan_id' => $kecamatan2->id]);
         Desa::create(['nama' => 'Desa 3', 'kecamatan_id' => $kecamatan3->id]);


         
        }
}
