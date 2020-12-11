<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AuthoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorites=[
            [
                'name_auth'=>'Admin'
            ],
            [
                'name_auth'=>'SuperUser'
            ],
            [
                'name_auth'=>'User'
            ]
        ];
        foreach($authorites as $authority){
            \App\Models\Authority::factory()->create($authority);
        }
    }
}
