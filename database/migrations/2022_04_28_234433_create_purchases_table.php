<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string("registrationNumber");
            $table->string("status")->default("prepared");
            $table->date("deliveryDate")->nullable();
            $table->double("total")->default(0.00);
            $table->timestamps();

            $table->unsignedBigInteger('provider_id')->nullable();
            $table->foreign("provider_id")->references("id")->on("providers");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
