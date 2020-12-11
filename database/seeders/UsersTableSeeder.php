<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            [
                'name_user'=>'Nguyen Viet Tung',
                'gender_user'=>true,
                'auth_user'=>'1'
            ],
            [
                'name_user'=>'Tu thi vong',
                'gender_user'=>false,
                'auth_user'=>'2'
            ],
            [
                'name_user'=>'Lung Thi Linh',
                'gender_user'=>false,
                'account_user'=>'hello@gmail.com',
            ]
        ];
        foreach($users as $user){
            \App\Models\User::factory()->create($user);
        }
    }
}
