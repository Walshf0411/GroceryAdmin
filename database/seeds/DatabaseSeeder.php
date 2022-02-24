<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_costs')->insert([
            'delivery_charges' => 40
        ]);

        DB::table('statictable')->insert([
            'page' => 'delivery_limit',
            'content' => '999'
        ]);
    }
}
