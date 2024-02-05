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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
		    $table->text('desc')->nullable();
		    $table->string('sku')->default('');
		    $table->integer('category_id');
            $table->double('pv', 8, 2);
            $table->string('image_url')->nullable();
            $table->boolean('active')->default(1);
		    $table->integer('inventory_id')->nullable();
            $table->integer('discount_id')->nullable();
            $table->integer('modified_by')->nullable();
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
        Schema::dropIfExists('products');
    }
};
