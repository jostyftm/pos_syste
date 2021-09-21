<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('amount');
            $table->unsignedDecimal('price', 12)->default(0);
            $table->unsignedDecimal('discount', 12)->default(0);
            $table->unsignedDecimal('total_price', 12)->default(0);
            $table->timestamps();
            
            $table->primary(['order_id', 'product_id']);
            
            $table->foreign('order_id')->references('id')
            ->on('order_providers')->onDelete('cascade');

            $table->foreign('product_id')->references('id')
            ->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_order_items');
    }
}
