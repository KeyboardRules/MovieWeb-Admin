<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTheatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_movies_theaters', function (Blueprint $table) {
            $table->unsignedBigInteger("movie");
            $table->unsignedBigInteger("theater");
            $table->string("schedule",2000)->nullable();
            $table->date("from_date")->nullable();
            $table->date("to_date")->nullable();

            $table->foreign("theater")->references("id_theater")->on('tb_theaters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("movie")->references("id_movie")->on('tb_movies')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tb_movies_theaters');
    }
}
