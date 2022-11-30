<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/features.json');
        $data = json_decode($json);
        foreach($data as $obj){
            $feature = new Feature();
            $feature->isNumeric = 1;
            $feature->measure = mb_strtolower($obj->measure);
            $feature->slug = Str::slug($obj->unit);
            $feature->unit = mb_strtolower($obj->unit);
            $feature->symbol = mb_strtolower($obj->symbol);
            $feature->description = mb_strtolower($obj->description);
             $feature->resume =
             mb_strtolower($obj->measure).' : '.
             mb_strtolower($obj->unit).' : '.
             mb_strtolower($obj->symbol);
            $feature->save();
        }
    }
}
