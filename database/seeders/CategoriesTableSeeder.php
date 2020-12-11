<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            [
                'name_category' => 'Horror',
                'description' => 'Horror is a genre of speculative fiction which is intended to frighten, scare, or disgust'
            ],
            [
                'name_category' => 'Adventure',
                'description' => 'Adventure fiction is a genre of fiction that usually 
                presents danger, or gives the viewer a sense of excitement.'
            ],
            [
                'name_category' => 'Action',
                'description' => 'Action film is a film genre in which the protagonist 
                or protagonists are thrust into a series of events that typically include violence, extended fighting, physical feats, rescues and frantic chases.'
            ]
        ];
        foreach($categories as $category ){
            \App\Models\Category::factory()->create($category);
        }
    }
}
