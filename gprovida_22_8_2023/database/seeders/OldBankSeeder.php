<?php

namespace Database\Seeders;

use File;
use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OldBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Bank::truncate();

        $banks=json_decode(File::get("database/seeders/data/transfer/gprovide_g_banks.json"),true);
        foreach ($banks as $bank){
            DB::table('banks')->insert(array(
                'id'  => ((isset($bank['id'])) ? intval($bank['id']) : 0),
                'user_id'  => ((isset($bank['user_id'])) ? intval($bank['user_id']) : null),
                'currency_id'  => ((isset($bank['currency_id'])) ? intval($bank['currency_id']) : 1),
                'bank_name'  => ((isset($bank['bank_name'])) ? $bank['bank_name'] : ''),
                'bank_holder_name'  => ((isset($bank['bank_holder_name'])) ? $bank['bank_holder_name'] : ''),
                'bank_account_number'  => ((isset($bank['bank_account_number'])) ? $bank['bank_account_number'] : ''),
                'bank_branch'  => ((isset($bank['bank_branch'])) ? $bank['bank_branch'] : ''),
                'country'  => ((isset($bank['country'])) ? $bank['country'] : 'Nigeria'),
                'swift'  => ((isset($bank['swift'])) ? $bank['swift'] : ''),
                'type'  => ((isset($bank['type'])) ? $bank['type'] : ''),
                'status'  => ((isset($bank['status'])) ? intval($bank['status']) : 1),
                'bic'  => ((isset($bank['bic'])) ? $bank['bic'] : ''),
                'sort_code'  => ((isset($bank['sort_code'])) ? $bank['sort_code'] : ''),
                'routing_no'  => ((isset($bank['routing_no'])) ? $bank['routing_no'] : ''),
                'default'  => ((isset($bank['default'])) ? intval($bank['default']) : 0),
                'created_at'  => ((isset($bank['created_at'])) ? $bank['created_at'] : date("Y-m-d H:i:s")),
                'updated_at'  => ((isset($bank['updated_at'])) ? $bank['updated_at'] : date("Y-m-d H:i:s"))
            ));
        }
    }
}
