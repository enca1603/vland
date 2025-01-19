<?php

namespace Database\Seeders;

use App\Models\Sifat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SifatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sifat::create(['sifat'=>'Biasa']);
        Sifat::create(['sifat'=>'Segera']);
        Sifat::create(['sifat'=>'Rahasia']);
    }
}
