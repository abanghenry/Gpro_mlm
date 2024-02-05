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
        Schema::table('users', function (Blueprint $table) {
            $table->double('current_binary_pv', 8,2)->after('deleted_at')->nullable();
            $table->double('spill_over_binary_pv', 8,2)->after('current_binary_pv')->nullable();
            $table->double('cumulative_binary_pv', 12,2)->after('spill_over_binary_pv')->nullable();
            $table->date('last_cycle_binary')->after('cumulative_binary_pv')->nullable();

            $table->double('current_direct_pv', 8,2)->after('last_cycle_binary')->nullable();
            $table->double('spill_over_direct_pv', 8,2)->after('current_direct_pv')->nullable();
            $table->double('cumulative_direct_pv', 12,2)->after('spill_over_direct_pv')->nullable();
            $table->date('last_cycle_direct')->after('cumulative_direct_pv')->nullable();

            $table->double('wallet', 12,2)->after('last_cycle_direct')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('current_binary_pv');
            $table->dropColumn('spill_over_binary_pv');
            $table->dropColumn('cumulative_binary_pv');
            $table->dropColumn('last_cycle_binary');

            $table->dropColumn('current_direct_pv');
            $table->dropColumn('spill_over_direct_pv');
            $table->dropColumn('cumulative_direct_pv');
            $table->dropColumn('last_cycle_direct');
        });
    }
};
