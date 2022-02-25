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
        [
            'page' => 'delivery_limit',
            'content' => '999'
        ],
        [
            'page' => 'share',
            'content' => 'Share app details shown in Grocery app'
        ],
        [
            'page' => 'about',
            'content' => 'About us details to show in Grocery app'
        ],
        [
            'page' => 'contact',
            'content' => 'Contact details to show in Grocery app'
        ],
        [
            'page' => 'terms',
            'content' => 'Terms & condition to show in Grocery app'
        ]
        ]);
    }
}
