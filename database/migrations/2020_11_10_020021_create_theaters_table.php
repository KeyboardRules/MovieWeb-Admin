<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_theaters', function (Blueprint $table) {
            $table->id("id_theater");
            $table->string("name_theater");
            $table->text("address_theater")->nullable();
            $table->text("image_theater")->nullable();
            $table->text("description_theater")->nullable();
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
        Schema::dropIfExists('tb_theaters');
    }
}
