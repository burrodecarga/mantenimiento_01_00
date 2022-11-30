<?php

namespace Database\Factories;

use App\Models\Prototype;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'prototype_id'=>Prototype::all()->random()->id,
           'name'=>$this->faker->swiftBicNumber(),
           'slug'=>$this->faker->swiftBicNumber(),
           'description'=>$this->faker->text(100),
           'location'=>Zone::all()->random()->id,
           'service'=>$this->faker->numberBetween($min = 1, $max = 24)
        ];
    }
}
