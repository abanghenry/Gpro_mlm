<?php

namespace Database\Seeders;

use File;
use App\Models\Award;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Award::truncate();

        $awards=json_decode(File::get("database/seeders/data/awards.json"),true);
        foreach ($awards as $award){
            DB::table('awards')->insert(array(
                'name'  => ((isset($award['name'])) ? $award['name'] : ''),
                'pv'  => ((isset($award['incentive_points'])) ? $award['incentive_points'] : ''),
                'cash_equivalent'  => ((isset($award['cash_equivalent'])) ? $award['cash_equivalent'] : ''),
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ));
        }


    }
}
