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
        Schema::create('upgrade_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('sponsor_id');
            $table->string('old_package_id');
            $table->string('old_package_name');
            $table->string('old_package_pv');
            $table->string('old_package_cost');
            $table->string('new_package_id');
            $table->string('new_package_name');
            $table->string('new_package_pv');
            $table->string('new_package_cost');
            $table->string('balance_pv')->nullable();
            $table->string('balance_referral_bonus')->nullable();
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
        Schema::dropIfExists('upgrade_records');
    }
};
