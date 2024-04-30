<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VilleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ville::updateOrCreate(['name' => 'Casabalanca']);
        Ville::updateOrCreate(['name' => 'Rabat']);
        Ville::updateOrCreate(['name' => 'Tanger']);
        Ville::updateOrCreate(['name' => 'Fes']);
    }
}
