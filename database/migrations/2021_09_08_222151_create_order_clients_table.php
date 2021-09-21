<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedInteger('order_state_id');
            $table->unsignedDecimal('price', 12)->default(0);
            $table->unsignedDecimal('discount', 12)->default(0);
            $table->unsignedDecimal('total_price', 12)->default(0);
            $table->timestamps();

            $table->foreign('client_id')->references('id')
            ->on('clients')->onDelete('cascade');

            $table->foreign('seller_id')->references('id')
            ->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('order_clients');
    }
}
