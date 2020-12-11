<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_reviews', function (Blueprint $table) {
            $table->id("id_review");
            $table->unsignedBigInteger("person_review");
            $table->unsignedBigInteger("movie_review");
            $table->float("score_review")->default(0)->unsigned();
            $table->text("content_review")->nullable();

            $table->foreign("person_review")->references("id_user")->on('tb_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("movie_review")->references("id_movie")->on('tb_movies')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tb_reviews');
    }
}
