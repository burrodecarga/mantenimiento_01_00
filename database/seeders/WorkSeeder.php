<?php

namespace Database\Seeders;

use App\Interfaces\DatosServiceInterface;
use App\Models\Fail;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(DatosServiceInterface $datosServiceInterface)
    {
        $fails = Fail::all();
        foreach ($fails as $f){
            $ids =   User::inRandomOrder()->where('id','>',9)->take(rand(1,3))->pluck('id');
            foreach ($ids as $id){
                $datosServiceInterface->assignWork($id,$f->id);
            }
        }

    }
}
