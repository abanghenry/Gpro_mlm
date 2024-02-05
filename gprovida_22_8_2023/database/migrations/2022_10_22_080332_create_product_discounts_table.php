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
        Schema::create('product_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
		    $table->text('desc')->nullable();
            $table->enum('type', ['percentage', 'fixed']);
            $table->double('value', 8, 2)->comment('percentage value or amount');
            $table->boolean('active');
            $table->timestamps();
            $table->integer('modified_by')->nullable();
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
        Schema::dropIfExists('product_discounts');
    }
};
