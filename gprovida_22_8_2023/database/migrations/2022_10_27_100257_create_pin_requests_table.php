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
        Schema::create('pin_requests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('package_id')->unsigned();
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->string('status')->nullable();

            $table->integer('quantity');
            $table->string('amount_paid');

            $table->string('payment_mode')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank')->nullable();
            $table->string('payment_details')->nullable(); // json before
            $table->string('transaction_teller')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pin_requests');
    }
};
