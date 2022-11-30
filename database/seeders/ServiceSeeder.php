<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;



class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/services.json');
        $data = json_decode($json);
        foreach($data as $obj){
            $replacement= new Service();
            $replacement->name = mb_strtolower($obj->name);
            $replacement->slug = Str::slug($obj->name);
            $replacement->price = ($obj->price);
            $replacement->supply = mb_strtolower($obj->supply);
            $replacement->description = mb_strtolower($obj->description);
            $replacement->save();
        }
    }
}
