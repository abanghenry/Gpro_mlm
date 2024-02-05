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
        Schema::create('pins', function (Blueprint $table) {
            $table->id();
            $table->string('pin_number')->unique();
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('pin_request_id')->nullable();
            $table->string('status')->comment('1=used, 0=unused, 2=cancelled');
            $table->unsignedBigInteger('used_for')->nullable();
            $table->string('package_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pins');
    }
};
