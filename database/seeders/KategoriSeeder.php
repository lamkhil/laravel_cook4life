<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::factory()->create([
            'nama_kategori' => 'Ayam',
            'foto' =>'images/Kategori/ayam.png',
        ]);
        Kategori::factory()->create([
            'nama_kategori' => 'Bayam',
            'foto' =>'images/Kategori/bayam.png', 
        ]);
        Kategori::factory()->create([
            'nama_kategori' => 'Daging Sapi',
            'foto' =>'images/Kategori/daging%20sapi.png', 
        ]);
        Kategori::factory()->create([
            'nama_kategori' => 'Ikan',
            'foto' =>'images/Kategori/ikan.png', 
        ]);
        Kategori::factory()->create([
            'nama_kategori' => 'Jamur',
            'foto' =>'images/Kategori/jamur.png', 
        ]);
        Kategori::factory()->create([
            'nama_kategori' => 'Kentang',
            'foto' =>'images/Kategori/kentang.png', 
        ]);Kategori::factory()->create([
            'nama_kategori' => 'Kue',
            'foto' =>'images/Kategori/kue.png', 
        ]);Kategori::factory()->create([
            'nama_kategori' => 'Mie',
            'foto' =>'images/Kategori/mie.png', 
        ]);Kategori::factory()->create([
            'nama_kategori' => 'Nasi',
            'foto' =>'images/Kategori/nasi.png', 
        ]);Kategori::factory()->create([
            'nama_kategori' => 'Telor',
            'foto' =>'images/Kategori/telor.png', 
        ]);Kategori::factory()->create([
            'nama_kategori' => 'Terong',
            'foto' =>'images/Kategori/terong.png', 
        ]);Kategori::factory()->create([
            'nama_kategori' => 'Wortel',
            'foto' =>'images/Kategori/wortel.png', 
        ]);
    }
}
