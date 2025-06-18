<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\likes;
use App\Models\Post;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\likes>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $post = Post::inRandomOrder()->first() ?? Post::factory()->create();
        return [
            'user_id' => User::factory(),
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post),
        ];
    }
}
