<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name =$this->faker->jobTitle();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'price'=>$this->faker->randomFloat($nbMaxDecimals =2, $min = 120, $max = 45000),
            'supply'=>$this->faker->company(),
            'description'=>$this->faker->text(120)
        ];
    }
}
