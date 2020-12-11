<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movies=[
            [
                'name_movie' => 'John Wick',
                'date_movie' => '2014-10-24',
                'image_movie' => 'https://images-na.ssl-images-amazon.com/images/I/71WiYBT2QsL._AC_SY741_.jpg',
                'trailer_movie' => 'https://www.youtube.com/embed/2AUmvWm5ZDQ',
                'length_movie'=>'90',
                'content_movie' => 'An ex-hit-man comes out of retirement to track down the gangsters that killed his dog and took everything from him.'
            ],
            [
                'name_movie' =>'Life of Pi',
                'image_movie' => 'https://i-ione.vnecdn.net/2012/12/10/life-of-pi-poster01-724801-1372590725_500x0.jpg?w=460&h=0&q=100&dpr=1&fit=crop&s=HlUclIbPEdxxqXVNKRiXOA',
                'trailer_movie' => 'https://www.youtube.com/embed/3mMN693-F3U',
                'length_movie'=>'90',
                'content_movie'=>'A young man who survives a disaster at sea is hurtled into an epic journey of adventure and discovery. While cast away, he forms an unexpected connection with another survivor: a fearsome Bengal tiger.'
            ]
        ];
        foreach($movies as $movie){
            \App\Models\Movie::factory()->create($movie);
        }
    }
}
