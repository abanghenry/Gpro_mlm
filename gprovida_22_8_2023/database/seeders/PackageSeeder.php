<?php

namespace Database\Seeders;

use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Package::truncate();

        DB::table('packages')->insert([
            'name' => 'Starter',
            'description' => 'start Package',
            'type' => 'pacakge',
            'referral_bonus' => '35',
            'image' => "" ,
            'status' => 1,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        DB::table('packages')->insert([
            'name' => 'Jasper',
            'description' => 'Jasper Package',
            'type' => 'pacakge',
            'referral_bonus' => '35',
            'image' => "" ,
            'status' => 1,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);


        DB::table('packages')->insert([
            'name' => 'Emerald',
            'description' => 'Emerald Package',
            'type' => 'pacakge',
            'referral_bonus' => '35',
            'image' => "" ,
            'status' => 1,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);

        DB::table('packages')->insert([
            'name' => 'Topaz',
            'description' => 'Topaz Package',
            'type' => 'pacakge',
            'referral_bonus' => '35',
            'image' => "" ,
            'status' => 1,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);


        DB::table('packages')->insert([
            'name' => 'Ruby',
            'description' => 'Ruby Package',
            'type' => 'pacakge',
            'referral_bonus' => '35',
            'image' => "" ,
            'status' => 1,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);




    }
}
