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
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('amount');
            $table->unsignedDecimal('price')->default(0);
            $table->unsignedDecimal('discount')->default(0);
            $table->unsignedDecimal('total_price')->default(0);
            $table->timestamps();
            
            $table->primary(['provider_id', 'product_id']);
            
            $table->foreign('provider_id')->references('id')
            ->on('providers')->onDelete('cascade');

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
