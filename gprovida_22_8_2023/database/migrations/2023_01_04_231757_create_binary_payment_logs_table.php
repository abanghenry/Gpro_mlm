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
        Schema::create('binary_payment_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->integer('strong_leg_id');
            $table->string('strong_leg_pv');
            $table->string('strong_leg_cf')->nullable();

            $table->integer('weak_leg_id');
            $table->string('weak_leg_pv');
            $table->string('weak_leg_cf')->nullable();

            $table->string('match_sv_used');
            $table->string('no_of_match');
            $table->string('pv_to_amount');
            $table->string('estimate_earning');
            $table->string('earning');

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
        Schema::dropIfExists('binary_payment_logs');
    }
};
