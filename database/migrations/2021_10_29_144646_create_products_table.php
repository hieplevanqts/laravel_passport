<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('slug');
            $table->text('image');
            $table->text('code');
            $table->text('description');
            $table->text('content');
            $table->text('description_seo');
            $table->text('title_seo');
            $table->text('keyword_seo');
            $table->integer('status');
            $table->integer('home');
            $table->integer('hot');
            $table->integer('focus');
            $table->integer('view');
            $table->integer('sort')->nullable();
            $table->integer('price');
            $table->integer('price_sale');
            $table->integer('rate');
            $table->foreignId('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            // $table->foreignId('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('store_id');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
