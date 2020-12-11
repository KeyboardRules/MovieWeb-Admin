<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title_blog'=>$this->faker->name,
            'content_blog'=>$this->faker->sentence(10),
            'status_blog'=>true,
            'author_blog'=>1
        ];
    }
}
