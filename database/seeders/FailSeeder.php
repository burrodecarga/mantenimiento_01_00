<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Fail;
use App\Models\Replacement;
use App\Models\Service;
use App\Models\Supply;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use vendor\bluemmb\faker_picsum_photos_provider\PicsumPhotosProvider;

class FailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fails = Fail::all();
        foreach ($fails as $g) {
            //$faker = Faker::create();
            $teamId = Team::inRandomOrder()->take(1)->pluck('id');
            $replacements = Replacement::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $supplies = Supply::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $services = Service::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $g->replacements()->attach($replacements, [
                'price' => rand(57, 500),
                'quantity' => rand(1, 5),
                'total' => rand(578, 5000),
            ]);

            $g->supplies()->attach($supplies, [
                'price' => rand(57, 500),
                'quantity' => rand(1, 5),
                'total' => rand(578, 5000),
            ]);

            $g->services()->attach($services, [
                'price' => rand(57, 500),
                'total' => rand(578, 5000),
            ]);

            $g->teams()->attach($teamId);

        }

    }
}
