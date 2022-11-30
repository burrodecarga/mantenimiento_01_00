<?php

namespace Database\Seeders;

use App\Models\Protocol;
use App\Models\Prototype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProtocolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/protocols.json');
        $data = json_decode($json);
        foreach($data as $obj){
            $protocol = new Protocol();
            $protocol->specialty_id = mb_strtolower($obj->specialty_id);
            $protocol->task = mb_strtolower($obj->task);
            $protocol->detail = mb_strtolower($obj->detail);
            $protocol->frecuency = mb_strtolower($obj->frecuency);
            $protocol->security = mb_strtolower($obj->security);
            $protocol->workers = mb_strtolower($obj->workers);
            $protocol->conditions = mb_strtolower($obj->conditions);
            $protocol->task_id = mb_strtolower($obj->task_id);
            $protocol->save();

            // DB::table('protocol_prototype')->insert(
            //     ['protocol_id' => $protocol->id, 'prototype_id' => $obj->prototype_id]
            // );
        }

        //  $json = File::get('database/data/feature_prototype.json');
        //  $data = json_decode($json);
        //  foreach($data as $obj){
        //      DB::table('feature_prototype')->insert(
        //          ['feature_id' => $obj->feature_id, 'prototype_id' => $obj->prototype_id]
        //      );
        //  }

    }
}
