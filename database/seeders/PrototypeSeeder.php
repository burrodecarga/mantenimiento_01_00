<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Protocol;
use App\Models\Prototype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Nette\Utils\Random;

class PrototypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/prototipo.json');
        $data = json_decode($json);
        foreach($data as $obj){
            $prototype = new Prototype();
            $prototype->name = mb_strtolower($obj->name);
            $prototype->cha_1 = mb_strtolower($obj->cha_1);
            $prototype->cha_2 = mb_strtolower($obj->cha_2);
            $prototype->cha_3 = mb_strtolower($obj->cha_3);
            $prototype->cha_4 = mb_strtolower($obj->cha_4);
            $prototype->save();


            $random = Rand(7,17);
            $protocols = Protocol::inRandomOrder()->limit($random)->get();
            $prototype->protocols()->attach($protocols);

            $random = Rand(7,30);
            $features = Feature::inRandomOrder()->limit($random)->get();
            $prototype->features()->attach($features);



        }
    }
}
