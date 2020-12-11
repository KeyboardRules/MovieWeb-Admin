<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_movie' => $this->faker->name,
            'date_movie' => Carbon::now(),
            'image_movie' => $this->faker->sentence(10),
            'trailer_movie' => $this->faker->sentence(10),
            'content_movie' => $this->faker->sentence(10)
        ];
    }
}
