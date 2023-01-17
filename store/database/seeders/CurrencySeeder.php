<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Comment if it will be production
//        DB::table('currencies')->truncate();

        DB::table('currencies')->insert([
            [
                'slug'    => 'RUB',
                'symbol'  => '₽',
                'is_main' => 1,
                'rate'    => 1,
                'updated_at' => now(),
            ],
            [
                'slug'    => 'USD',
                'symbol'  => '$',
                'is_main' => 0,
                'rate'    => 0,
                'updated_at' => now(),
            ],
            [
                'slug'    => 'EUR',
                'symbol'  => '€',
                'is_main' => 0,
                'rate'    => 0,
                'updated_at' => now(),
            ],
        ]);
    }
}
