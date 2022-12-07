<?php

namespace Database\Seeders;

use App\Models\Goal;
use App\Models\Replacement;
use App\Models\Service;
use App\Models\Supply;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $goals = Goal::all();
        foreach ($goals as $g) {
            //$faker = Faker::create();
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

        }

    }
}
