<?php

namespace Database\Seeders;

use App\Models\Replacement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ReplacementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/replacements.json');
        $data = json_decode($json);
        foreach($data as $obj){
            $replacement= new Replacement();
            $replacement->name = mb_strtolower($obj->name);
            $replacement->slug = Str::slug($obj->name);
            $replacement->brand = mb_strtolower($obj->brand);
            $replacement->price = ($obj->price);
            $replacement->stock = ($obj->stock);
            $replacement->supply = mb_strtolower($obj->supply);
            $replacement->description = mb_strtolower($obj->description);
            $replacement->save();
        }

    }
}
