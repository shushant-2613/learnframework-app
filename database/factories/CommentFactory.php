<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = Post::inRandomOrder()->first()->id;
        return [
            'commentcontent' => fake()->words($nb = 3, $varibleNbWords = true),
            'post_id' => $id,
        ];
    }
}
