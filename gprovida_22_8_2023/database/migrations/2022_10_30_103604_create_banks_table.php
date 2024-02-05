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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('currency_id');
            $table->string('bank_name');
            $table->string('bank_holder_name');
            $table->string('bank_account_number');
            $table->string('bank_branch')->nullable();
            $table->string('country');
            $table->string('type');
            $table->string('swift')->nullable();
            $table->string('bic')->nullable();
            $table->string('sort_code')->nullable();
            $table->string('routing_no')->nullable();
            $table->boolean('status')->comment('1=active 0=pending');
            $table->boolean('default')->default(0);
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
        Schema::dropIfExists('banks');
    }
};
