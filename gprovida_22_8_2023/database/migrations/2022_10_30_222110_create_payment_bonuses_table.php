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
        Schema::create('payment_bonuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('payment_id');
            $table->unsignedInteger('bonus_id');
            $table->string('bonus_type')->comment("referral, binary");
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
        Schema::dropIfExists('payment_bonuses');
    }
};
