<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model  = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->realText(50),
            "body" => $this->faker->realText(100),
            "user_id" => function (){
                return User::factory()->create()->id;
            },
        ];
    }
}
