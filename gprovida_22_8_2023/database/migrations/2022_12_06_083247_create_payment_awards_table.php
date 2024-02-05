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
        Schema::create('payment_awards', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->double('current_pv_used', 20, 2)->nullable();

            $table->integer('award_id');
            $table->string('award_name');
            $table->double('cash_equivalent', 20, 2)->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->string('status')->comment("pending, processing, paid");
            $table->string('description')->nullable();
            $table->dateTime('date_time_paid', $precision = 0)->nullable();
            $table->dateTime('date_time_to_pay', $precision = 0)->nullable();
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
        Schema::dropIfExists('payment_awards');
    }
};
