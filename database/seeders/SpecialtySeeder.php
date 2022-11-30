<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/specialties.json');
        $data = json_decode($json);

        foreach ($data as $obj){
         $specialty = new Specialty();
         $specialty->name = mb_strtolower($obj->name);
         $specialty->save();
        }
    }
}
