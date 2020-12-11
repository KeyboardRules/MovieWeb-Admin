<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_user'=>$this->faker->name,
            'gender_user'=>true,
            'birth_user'=>$this->faker->date,
            'image_user'=>'',
            'email_user'=>null,
            'account_user'=>$this->faker->unique->email,
            'password_user'=>password_hash('password', PASSWORD_DEFAULT),
            'remember_token'=>Str::random(10),
            'auth_user'=>'3'
        ];
    }
}
