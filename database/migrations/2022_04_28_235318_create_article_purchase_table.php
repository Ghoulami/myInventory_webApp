<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_purchase', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('article_id');
            $table->unsignedInteger('purchase_id');
            $table->double('qte')->default(0);
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('purchase_id')->references('id')->on('purchases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_purchase');
    }
}
