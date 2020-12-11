<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_blogs', function (Blueprint $table) {
            $table->id("id_blog");
            $table->string("title_blog");
            $table->text("content_blog");
            $table->boolean("status_blog")->default(false);
            $table->unsignedBigInteger('author_blog')->nullable();

            $table->foreign("author_blog")->references("id_user")->on('tb_users')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('tb_blogs');
    }
}
