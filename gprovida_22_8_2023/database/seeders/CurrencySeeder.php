<?php

namespace Database\Seeders;



use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Currency::truncate();

        DB::table('currencies')->insert([
            'name' => 'Nigerian Naira',
            'code' => 'NGN',
            'prefix' => '₦',
            'suffix' => ' ',
            'format' => 1.00 ,
            'BaseRate' => 0.00000,
            'base' => 1,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        DB::table('currencies')->insert([
            'name' => 'British Pounds',
            'code' => 'GBP',
            'prefix' => '£',
            'suffix' => ' ',
            'format' => 1.00 ,
            'BaseRate' => 800.00000,
            'base' => 0,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        DB::table('currencies')->insert([
            'name' => 'United state Dollar',
            'code' => 'USD',
            'prefix' => '$',
            'suffix' => ' ',
            'format' => 1.00 ,
            'BaseRate' => 740.00000,
            'base' => 0,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        DB::table('currencies')->insert([
            'name' => 'Euro',
            'code' => 'EUR',
            'prefix' => '€',
            'suffix' => ' ',
            'format' => 1.00 ,
            'BaseRate' => 740.00000,
            'base' => 0,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

    }
}
