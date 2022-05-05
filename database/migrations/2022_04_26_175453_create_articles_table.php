<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->double('taxes')->default(0.00);
            $table->double('weight')->default(0.00)->nullable();
            $table->double('volume')->default(0.00)->nullable();
            $table->double('qteInStock')->default(0.00)->nullable();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign("category_id")->references("id")->on("categories");

            $table->unsignedBigInteger('stock_id')->nullable();
            $table->foreign("stock_id")->references("id")->on("stocks");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
