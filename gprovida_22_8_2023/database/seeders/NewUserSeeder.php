<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();

        $users=json_decode(File::get("database/seeders/data/transfer/gprovide_new_users_2.json"),true);
        foreach ($users as $user){
            DB::table('users')->insert(array(
                'id'  => ((isset($user['id'])) ? intval($user['id']) : 0),
                'firstname'  => ((isset($user['firstname'])) ? $user['firstname'] : ''),
                'lastname'  => ((isset($user['lastname'])) ? $user['lastname'] : ''),
                'username'  => ((isset($user['username'])) ? $user['username'] : ''),
                'gender'  => ((isset($user['gender'])) ? $user['gender'] : 'male'),
                'email'  => ((isset($user['email'])) ? $user['email'] : ''),
                'email_verified_at'  => ((isset($user['email_verified_at'])) ? $user['email_verified_at'] : date("Y-m-d H:i:s")),
                'profession'  => ((isset($user['profession'])) ? $user['profession'] : ''),
                'skills'  => ((isset($user['skills'])) ? $user['skills'] : ''),
                'phone'  => ((isset($user['phone'])) ? $user['phone'] : ''),
                'address'  => ((isset($user['address'])) ? $user['address'] : ''),
                'address2'  => ((isset($user['address2'])) ? $user['address2'] : ''),
                'state'  => ((isset($user['state'])) ? $user['state'] : ''),
                'city'  => ((isset($user['city'])) ? $user['city'] : ''),
                'country'  => ((isset($user['country'])) ? $user['country'] : ''),
                'referred_by'  => ((isset($user['referred_by'])) ? intval($user['referred_by']) : 1),
                'parent'  => ((isset($user['parent'])) ? intval($user['parent']) : null),
                'position'  => ((isset($user['position'])) ? intval($user['position']) : null),
                'stage_id'  => ((isset($user['stage_id'])) ? intval($user['stage_id']) : 0),
                'package_id'  => ((isset($user['pack_id'])) ? intval($user['pack_id']) : 1),
                'payment_method'  => ((isset($user['payment_method'])) ? $user['payment_method'] : 'bank'),
                'currency_id'  => ((isset($user['currency_id'])) ? intval($user['currency_id']) : 1),
                'active'  => ((isset($user['active'])) ? intval($user['active']) : 1),
                'welcomed'  => ((isset($user['welcomed'])) ? intval($user['welcomed']) : 1),
                'date_activated'  => ((isset($user['date_activated'])) ? $user['date_activated'] : date("Y-m-d H:i:s")),
                'verification_token'  => ((isset($user['verification_token'])) ? $user['verification_token'] : ''),
                'type'  => ((isset($user['type'])) ? intval($user['type']) : 1),
                'rank'  => ((isset($user['rank'])) ? $user['rank'] : ""),
                'registration_pin'  => ((isset($user['registration_pin'])) ? $user['registration_pin'] : ''),
                'password'  => ((isset($user['password'])) ? $user['password'] : ''),
                'remember_token'  => ((isset($user['remember_token'])) ? $user['remember_token'] : ''),
                'last_login_date'  => ((isset($user['last_login_date'])) ? $user['last_login_date'] : null),
                'last_login_ip'  => ((isset($user['last_login_ip'])) ? $user['last_login_ip'] : ''),
                'created_at'  => ((isset($user['created_at'])) ? $user['created_at'] : null),
                'updated_at'  => ((isset($user['updated_at'])) ? $user['updated_at'] : null),
                'deleted_at'  => ((isset($user['deleted_at'])) ? $user['deleted_at'] : null),
                'current_binary_pv'  => ((isset($user['current_binary_pv'])) ? floatval($user['current_binary_pv']) : 0.00),
                'spill_over_binary_pv'  => ((isset($user['spill_over_binary_pv'])) ? floatval($user['spill_over_binary_pv']) : 0.00),
                'cumulative_binary_pv'  => ((isset($user['cumulative_binary_pv'])) ? floatval($user['cumulative_binary_pv']) : 0.00),
                'last_cycle_binary'  => ((isset($user['last_cycle_binary'])) ? $user['last_cycle_binary'] : null),
                'current_direct_pv'  => ((isset($user['current_direct_pv'])) ? floatval($user['current_direct_pv']) : 0.00),
                'spill_over_direct_pv'  => ((isset($user['spill_over_direct_pv'])) ? floatval($user['spill_over_direct_pv']) : 0.00),
                'cumulative_direct_pv'  => ((isset($user['cumulative_direct_pv'])) ? floatval($user['cumulative_direct_pv']) : 0.00),
                'last_cycle_direct'  => ((isset($user['last_cycle_direct'])) ? $user['last_cycle_direct'] : null),
                'wallet'  => ((isset($user['wallet'])) ? floatval($user['wallet']) : 0.00),
            ));
        }
    }
}
