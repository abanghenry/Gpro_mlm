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
        Schema::create('payment_job_logs', function (Blueprint $table) {
            $table->id();
            $table->string('job_name');
            $table->dateTime('date_from')->nullable();
            $table->dateTime('date_to')->nullable();
            $table->integer('no_of_payment_generated')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
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
        Schema::dropIfExists('payment_job_logs');
    }
};
