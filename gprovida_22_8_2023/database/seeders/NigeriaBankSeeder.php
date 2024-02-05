<?php

namespace Database\Seeders;


use File;
use Carbon\Carbon;
use App\Models\NigeriaBank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NigeriaBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        NigeriaBank::truncate();

        $supportedBanks=json_decode(File::get("database/seeders/data/banks.json"),true);
        foreach ($supportedBanks as $bank){
            DB::table('nigeria_banks')->insert(array(
                'name'  => ((isset($bank['name'])) ? $bank['name'] : ''),
                'code'  => ((isset($bank['code'])) ? $bank['code'] : ''),
                'country'  => ((isset($bank['country'])) ? $bank['country'] : 'NGN'),
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ));
        }

    }
}
