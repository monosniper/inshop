<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Shop;
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
            'shop_id' => Shop::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'subtitle' => $this->faker->sentence,
            'price' => $this->faker->randomElement([49, 79, 139, 149, 179, 249, 349]),
            'description' => $this->faker->realText(1000),
        ];
    }
}
