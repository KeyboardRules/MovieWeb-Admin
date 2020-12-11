<?php

namespace Database\Factories;

use App\Models\Authority;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Authority::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_auth' => $this->faker->name,
        ];
    }
}
