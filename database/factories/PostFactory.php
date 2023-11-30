<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = User::inRandomOrder()->first()->id;
        
        return [
            'postcontent' => fake()->words($nb = 10, $varibleNbWords = true),
            'user_id' => $id,
        ];
    }
}
