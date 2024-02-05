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
        Schema::create('bonus_direct_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('owner');
            $table->double('pv', 8, 2)->nullable();
            $table->dateTime('date_time_earned', $precision = 0);
            $table->string('source')->default('product_direct')->comment("product_direct");
            $table->dateTime('date_time_paid', $precision = 0)->nullable();
            $table->integer('status')->comment('0=pending 1=processing 2=paid 3=flushed 4=cforward');
            $table->string('details')->nullable();
            $table->integer('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonus_direct_purchases');
    }
};
