<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Product;
use Ramsey\Uuid\Uuid as Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Generator::uuid4()->toString(),
            'name' => $this->faker->numerify('Product ###'),
            'desc' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'price' => $this->faker->numberBetween($min = 20000, $max = 100000),
            'qty' => $this->faker->numberBetween($min = 10, $max = 100),
        ];
    }
}
