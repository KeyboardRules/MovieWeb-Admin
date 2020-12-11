<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_comments', function (Blueprint $table) {
            $table->id("id_comment");
            $table->unsignedBigInteger("person_comment");
            $table->unsignedBigInteger("blog_comment");
            $table->text("content_comment");

            $table->foreign("person_comment")->references("id_user")->on('tb_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("blog_comment")->references("id_blog")->on('tb_blogs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tb_comments');
    }
}
