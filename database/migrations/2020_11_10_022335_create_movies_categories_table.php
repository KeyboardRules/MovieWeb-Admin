<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_movies_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('movie');
            $table->unsignedBigInteger('category');
            $table->timestamps();

            $table->foreign("movie")->references("id_movie")->on('tb_movies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("category")->references("id_category")->on('tb_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_movies_categories');
    }
}
