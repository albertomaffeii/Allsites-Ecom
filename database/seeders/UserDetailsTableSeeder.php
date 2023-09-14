<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('user_details')->insert([
            'user_id' => 1,
            'personal_tax_code' => 'System Administrator',
            'panel_color' => 'bg-light',
        ]);
    }
}

