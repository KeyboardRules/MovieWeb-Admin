<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_movies', function (Blueprint $table) {
            $table->id("id_movie");
            $table->string("name_movie");
            $table->date("date_movie");
            $table->text("image_movie")->nullable();
            $table->text("trailer_movie")->nullable();
            $table->integer("length_movie")->default(0)->unsigned();
            $table->text("content_movie")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_movies');
    }
}
