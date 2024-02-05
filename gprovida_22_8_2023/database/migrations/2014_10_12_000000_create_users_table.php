<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->unique();
            $table->string('gender');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profession')->nullable();
            $table->string('skills')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('country');

            $table->unsignedBigInteger('referred_by')->nullable();
            $table->unsignedBigInteger('parent')->nullable();
            $table->string('position')->nullable();


            $table->integer('stage_id')->unsigned()->default(0);
            $table->unsignedBigInteger('package_id')->default(1);
            $table->string('payment_method')->nullable();
            $table->unsignedBigInteger('currency_id')->default(1)->comment("default currency id");


            $table->integer('active')->default(User::INACTIVE_USER);
            $table->integer('welcomed')->default(User::UNWELCOMED_USER);
            $table->dateTime('date_activated')->nullable();
            $table->string('verification_token')->nullable();
            $table->string('type')->default(User::REGULAR_USER);

            $table->string('rank')->nullable();



             $table->string('registration_pin')->nullable();


            $table->string('password');
            $table->rememberToken();
            $table->dateTime('last_login_date')->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('referred_by')->references('id')->on('users');
            $table->foreign('parent')->references('id')->on('users');
            $table->foreign('currency_id')->references('id')->on('currencies');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
