<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    protected $model = Campaign::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->name(),
            'description' => fake()->text(),
            'image_url' => fake()->imageUrl(),
            'slug' => fake()->slug(),
            'brand_id' => Brand::pluck('id')[fake()->numberBetween(1, Brand::count() - 1)],
            'is_active' => fake()->boolean(),
            'starts_at' => fake()->dateTimeThisYear(),
            'ends_at' => fake()->dateTimeThisYear(),
        ];
    }
}
