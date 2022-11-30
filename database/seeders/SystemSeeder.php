<?php

namespace Database\Seeders;

use App\Models\System;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        System::create(['name'=>'eléctrico','slug'=>'electrico']);
        System::create(['name'=>'transporte','slug'=>'transporte']);
        System::create(['name'=>'áreas verdes','slug'=>'areas-verdes']);
        System::create(['name'=>'aguas servidas','slug'=>'aguas-servidas']);
        System::create(['name'=>'montaje','slug'=>'montaje']);
        System::create(['name'=>'producción','slug'=>'produccion']);
        System::create(['name'=>'edificios e infraestructuras', 'slug' => 'edificios-e-infrestructura']);
    }
}
