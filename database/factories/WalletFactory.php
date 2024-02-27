<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    protected $model = Wallet::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => fake()->unique()->md5(),
            'strategy' => fake()->randomElement(['HODL', 'Trading', 'Mining', 'Staking', 'Lending', 'Others']),
            'label' => fake()->name(),
            'data' => fake()->text(),
            'user_id' => User::pluck('id')[fake()->numberBetween(1, User::count() - 1)],
        ];
    }
}
