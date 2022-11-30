<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fail>
 */
class FailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'equipment_id'=>Equipment::all()->random()->id,
            'type'=>$this->faker->randomElement(FALLA),
            'status'=>$this->faker->randomElement([0,1,1,1,1,0,1,0,1,0]),
            'user_id'=>User::all()->random()->id,
            'reported_at'=>$this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'repareid_at'=>$this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null)   //
        ];
    }
}
