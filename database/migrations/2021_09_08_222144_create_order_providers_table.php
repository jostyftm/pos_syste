<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_providers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->unsignedInteger('order_state_id');
            $table->unsignedDecimal('price', 12)->default(0);
            $table->unsignedDecimal('discount', 12)->default(0);
            $table->unsignedDecimal('total_price', 12)->default(0);
            $table->timestamps();

            $table->foreign('provider_id')->references('id')
            ->on('providers')->onDelete('cascade');
            
            $table->foreign('order_state_id')->references('id')
            ->on('order_states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_providers');
    }
}
