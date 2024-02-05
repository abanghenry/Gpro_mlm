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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('orderRef')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('owner_id');
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('currency_id');

            $table->integer('number_of_items');

            $table->double('total_sales',8,2);
            $table->double('total_tax',8,2);
            $table->double('total_shipping',8,2);
            $table->double('transaction_fee',8,2);
            $table->double('total_discount',8,2);
            $table->double('net_total',8,2);
            $table->string('status_order'); // pending, processing, shipped, cancelled, fraud

            $table->string('invoice_no')->nullable();
            $table->string('payment_method');
            $table->string('payment_status'); // pending, paid, part_payment cancelled, fraud
            $table->string('amount_paid')->nullable();
            $table->string('amount_balance')->nullable();
            $table->string('payment_ref')->nullable();
            $table->text('payment_details')->nullable();
            $table->date('payment_date')->nullable();

            $table->text('notes')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('stockist_paid')->default(0)->comment('1 if stockist bonus has been paid for this order');
            $table->integer('global_paid')->default(0)->comment('1 if Global Sales bonus has been paid for this order');
            $table->integer('special_paid')->default(0)->comment('1 if Special bonus has been paid for this order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
