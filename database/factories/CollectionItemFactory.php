<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\CollectionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CollectionItem>
 */
class CollectionItemFactory extends Factory
{
    protected $model = CollectionItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'image_url' => $this->faker->imageUrl(),
            'available' => $this->faker->boolean,
            'collection_id' => Collection::pluck('id')[fake()->numberBetween(1, Collection::count() - 1)],
        ];
    }
}
