<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
           [
               'name'         => 'Iphone X',
               'slug'         => 'iphone-x',
               'description'  => 'Великолепное устройство от Apple!',
               'price'        => '45000',
               'category_id'  => 1,
           ],
            [
                'name'         => 'Iphone 14 Pro Max',
                'slug'         => 'iphone-14-pro-max',
                'description'  => 'Умопомрочительный девайс!',
                'price'        => '155000',
                'category_id'  => 1,
            ],
            [
                'name'         => 'Наушники Monster Beats',
                'slug'         => 'monster-beats',
                'description'  => 'Качественное звучание!',
                'price'        => '49000',
                'category_id'  => 2,
            ],
            [
                'name'         => 'Стиральная машина Bosh',
                'slug'         => 'wash-mashin-bosh',
                'description'  => 'Ультро мягкая стирка!',
                'price'        => '35000',
                'category_id'  => 3,
            ],
        ]);
    }
}
