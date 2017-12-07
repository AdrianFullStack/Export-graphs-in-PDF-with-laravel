<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
        	['name' => 'Super Admin'],
        	['name' => 'Admin'],
        	['name' => 'Provider'],
        	['name' => 'Seller'],
        	['name' => 'Customer'],
        ]);
    }
}
