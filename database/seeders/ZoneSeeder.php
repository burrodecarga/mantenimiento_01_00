<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Zone::create(['name'=>'materia prima','slug'=>'materia-prima']);
        Zone::create(['name'=>'almacén','slug'=>'almacen']);
        Zone::create(['name'=>'patio norte','slug'=>'patio-norte']);
        Zone::create(['name'=>'estacionamiento','slug'=>'estacionamiento']);
        Zone::create(['name'=>'montaje','slug'=>'montaje']);
        Zone::create(['name'=>'producción','slug'=>'produccion']);
    }
}
