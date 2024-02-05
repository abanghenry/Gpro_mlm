<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        TicketStatus::truncate();

        DB::table('ticket_statuses')->insert([
            'name' => 'Open',
            'color' => '#779500',
            'sort_order' => 1,
            'show_active' => 1,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);
        DB::table('ticket_statuses')->insert([
            'name' => 'Answered',
            'color' => '#000000',
            'sort_order' => 2,
            'show_active' => 1,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);
        DB::table('ticket_statuses')->insert([
            'name' => 'Customer-Reply',
            'color' => '#888888',
            'sort_order' => 3,
            'show_active' => 1,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);
        DB::table('ticket_statuses')->insert([
            'name' => 'Closed',
            'color' => '#888888',
            'sort_order' => 10,
            'show_active' => 0,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);
        DB::table('ticket_statuses')->insert([
             'name' => 'On Hold',
             'color' => '#224488',
             'sort_order' => 5,
             'show_active' => 1,
             'created_at'=>date("Y-m-d H:i:s"),
             'updated_at'=>date("Y-m-d H:i:s"),
         ]);
        DB::table('ticket_statuses')->insert([
              'name' => 'In Progress',
              'color' => '#cc0000',
              'sort_order' => 6,
              'show_active' => 1,
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s"),
          ]);
    }
}
