<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_name' => $this->faker->word(),
            'category_id' => Category::factory()->create()->id,
            'supplier_id' => Supplier::factory()->create()->id,
            'quantity' => $this->faker->numberBetween(1, 100),
            'StockStatus' => $this->faker->randomElement(['in_stock', 'out_of_stock']),
            'unite' => $this->faker->randomElement(['kg', 'liters', 'pieces']),
        ];
    }
}
