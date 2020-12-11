<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TheatersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $theaters=[
            [
                'name_theater'=>'Rạp chiếu phim quốc gia',
                'address_theater'=>'87 Láng Hạ',
                'image_theater'=>'https://chieuphimquocgia.com.vn/Content/Images/uploaded/Gioi%20thieu/16641193303_c1419d4dd3_k.jpg'
            ],
            [
                'name_theater'=>'Rạp chiếu phim CGV',
                'address_theater'=>'Tầng 4,Plaza Hà Nội',
                'image_theater'=>'https://www.cgv.vn/media/site/cache/1/980x415/b58515f018eb873dafa430b6f9ae0c1e/d/s/dsc_0905.jpg'
            ]
        ];
        foreach($theaters as $theater){
            \App\Models\Theater::factory()->create($theater);
        }
    }
}
