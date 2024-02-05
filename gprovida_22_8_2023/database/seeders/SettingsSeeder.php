<?php

namespace Database\Seeders;

use File;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Setting::truncate();

        $supportedSettings=json_decode(File::get("database/seeders/data/settings.json"),true);
        foreach ($supportedSettings as $setting){
            DB::table('settings')->insert(array(
                'key'  => ((isset($setting['key'])) ? $setting['key'] : ''),
                'value'  => ((isset($setting['value'])) ? $setting['value'] : ''),
                'type'  => ((isset($setting['type'])) ? $setting['type'] : ''),
                'options'  => ((isset($setting['options'])) ? $setting['options'] : ''),
                'category'  => ((isset($setting['category'])) ? $setting['category'] : ''),
                'description'  => ((isset($setting['description'])) ? $setting['description'] : ''),
                'tooltip'  => ((isset($setting['tooltip'])) ? $setting['tooltip'] : ''),
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ));
        }


    }
}
