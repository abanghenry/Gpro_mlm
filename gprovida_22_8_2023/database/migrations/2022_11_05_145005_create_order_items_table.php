<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type')->comment('item, tax');
            $table->double('qty',8,2);
            $table->unsignedInteger('currency_id');
            $table->double('amount',8,2);
            $table->double('discount',8,2);
            $table->double('total',8,2);
            $table->string('status');// pending, processing, shipped, cancelled, fraud
            $table->unsignedInteger('store_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
