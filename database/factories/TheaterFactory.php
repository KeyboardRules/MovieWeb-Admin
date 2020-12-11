<?php

namespace Database\Factories;

use App\Models\Theater;
use Illuminate\Database\Eloquent\Factories\Factory;

class TheaterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Theater::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_theater'=>'null theater',
            'address_theater'=>'null address',
            'image_theater'=>'https://tacm.com/wp-content/uploads/2018/01/no-image-available.jpeg',
            'description_theater'=>'new theater'
        ];
    }
}
