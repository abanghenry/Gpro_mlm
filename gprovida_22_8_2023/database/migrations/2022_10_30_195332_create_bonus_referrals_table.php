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
        Schema::create('bonus_referrals', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('referral_id');
            $table->unsignedInteger('currency_id')->nullable();
            $table->string('currency_code')->nullable();
            $table->double('amount', 8, 2)->nullable();
            $table->double('pv', 8, 2)->nullable();
            $table->dateTime('date_time_earned', $precision = 0);
            $table->unsignedInteger('payment_id')->nullable();
            $table->string('source')->nullable();
            $table->dateTime('date_time_paid', $precision = 0)->nullable();
            $table->boolean('status')->comment('0=pending 1=processing 2=paid 3=cforward');

            $table->string('details')->nullable();
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
        Schema::dropIfExists('bonus_referrals');
    }
};
