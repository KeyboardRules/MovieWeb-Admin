<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tb_users');
        Schema::create('tb_users', function (Blueprint $table) {
            $table->id("id_user");
            $table->string('name_user',40)->nullable();
            $table->boolean('gender_user')->default(true);
            $table->date("birth_user")->default('1999-1-1');
            $table->text("image_user")->nullable();
            $table->string('email_user')->unique()->nullable();
            $table->string("account_user",40)->unique();
            $table->text('password_user');
            $table->rememberToken();
            $table->unsignedBigInteger("auth_user")->nullable();

            $table->foreign("auth_user")->references("id_auth")->on('tb_authorities')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('tb_users');
    }
}
