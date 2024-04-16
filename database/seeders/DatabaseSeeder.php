<?php

namespace Database\Seeders;

use App\Models\diseases_model;
use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret')
        ]);

        diseases_model::create([
            'name' => 'Salmonella',
            'description' => 'Disebabkan oleh Bakteri Salmonella. dapat menular melalui Feses yang terkontaminasi, kontak dengan hewan yang terinfeksi, telur yang terkontaminasi. Gejala: Diare, lemas, nafsu makan menurun, penurunan produksi telur.
            ',
            'solution' => 'Pengobatan: Antibiotik (tergantung jenis Salmonella), elektrolit, vitamin.
            Pencegahan: Sanitasi kandang yang baik, vaksinasi, kontrol hama.
            
            '
        ]);

        diseases_model::create([
            'name' => 'Newcastle Disease (ND)',
            'description' => 'Virus Avian Paramyxovirus serotype 1 (APMV-1).
            Penularan: Kontak langsung dengan hewan yang terinfeksi, aerosol (percikan air liur), feses.
            ',
            'solution' => 'Pengobatan: Tidak ada, hanya pengobatan suportif.
            Pencegahan: Vaksinasi, sanitasi kandang yang baik, biosecurity yang ketat.
            '
        ]);

        diseases_model::create([
            'name' => 'Ayam Terdeteksi Sehat',
            'description' => 'Ayam dalam keadan sehat walafiat',
            'solution' => '-'
        ]);

        $this->call([
            diseases_model::class,
        ]);
    }
}
