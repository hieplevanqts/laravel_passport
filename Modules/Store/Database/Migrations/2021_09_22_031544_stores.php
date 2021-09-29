<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Stores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug");
            $table->string("avatar")->nullable();
            $table->foreignId("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string("banner")->nullable();
            $table->string("address");
            $table->string("phone");
            $table->string("email");
            $table->double("longitude")->nullable();
            $table->double("latitude")->nullable();
            $table->integer("sort")->nullable();
            $table->integer("status");
            $table->text("description");
            $table->text("address_google")->nullable();
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
        Schema::dropIfExists('stores');
    }
}
