<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Replacement>
 */
class ReplacementFactory extends Factory
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
            'brand'=>$this->faker->company(),
            'price'=>$this->faker->randomFloat($nbMaxDecimals =2, $min = 120, $max = 45000),
            'stock'=>$this->faker->numberBetween($min = 1000, $max = 9000),
            'supply'=>$this->faker->company(),
            'description'=>$this->faker->text(120)
        ];
    }
}
