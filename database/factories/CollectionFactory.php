<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    protected $model = Collection::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => fake()->unique()->md5(),
            'slug' => fake()->slug(),
            'type' => fake()->randomElement(['NFT', 'FT']),
            'chain_id' => fake()->numberBetween(1, 10),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'image_url' => $this->faker->imageUrl(),
            'campaign_id' => Campaign::pluck('id')[fake()->numberBetween(1, Campaign::count() - 1)],
        ];
    }
}
