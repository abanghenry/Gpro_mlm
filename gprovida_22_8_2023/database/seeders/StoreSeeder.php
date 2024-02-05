<?php

namespace Database\Seeders;


use Carbon\Carbon;
use App\Models\Store;
use App\Models\Package;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Store::truncate();

        DB::table('stores')->insert([
            'name' => 'Main Store',
            'slug' => 'mainstore',
            'description' => 'GetProSkills Main Store',
            'address' => 'Papi Abuja',
            'address2' => '',
            'city' => "Abuja" ,
            'state' => "FCT" ,
            'country' => "Nigeria" ,
            'phone' => "234 807 300 7059" ,
            'email' => "gpsskills@gmail.com" ,
            'website'=>"www.getproskills.com",
            'map' => "" ,
            'image_url' => "" ,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);


    }
}
