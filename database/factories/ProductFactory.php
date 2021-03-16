<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => "Mobile ".$this->faker->unique()->numberBetween(1, 20),
            "description" => $this->faker->paragraph(5),
            "price" => $this->faker->numberBetween(1000, 10000)
        ];
    }
}
