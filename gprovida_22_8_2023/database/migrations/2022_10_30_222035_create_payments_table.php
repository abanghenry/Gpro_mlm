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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('description')->nullable();
            $table->double('amount', 8, 2)->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->string('bonus_type')->comment("referral, binary, unilevel");
            $table->string('status')->comment("paid, flushed, cforward");
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
        Schema::dropIfExists('payments');
    }
};
