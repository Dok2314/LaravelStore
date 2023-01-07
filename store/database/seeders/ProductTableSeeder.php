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
               'name'         => 'Iphone 11',
               'slug'         => 'iphone-11',
               'description'  => 'Великолепное устройство от Apple!',
               'price'        => '55000',
               'category_id'  => 1,
               'image'        => 'products/iphone11.jpeg'
           ],
            [
                'name'         => 'Iphone 14 Pro Max',
                'slug'         => 'iphone-14-pro-max',
                'description'  => 'Умопомрочительный девайс!',
                'price'        => '155000',
                'category_id'  => 1,
                'image'        => 'products/iphone14.jpg',
            ],
            [
                'name'         => 'Наушники Monster Beats',
                'slug'         => 'monster-beats',
                'description'  => 'Качественное звучание!',
                'price'        => '49000',
                'category_id'  => 2,
                'image'        => 'products/monster-beats.jpeg',
            ],
            [
                'name'         => 'Стиральная машина Bosh',
                'slug'         => 'wash-mashin-bosh',
                'description'  => 'Ультро мягкая стирка!',
                'price'        => '35000',
                'category_id'  => 3,
                'image'        => 'products/bosch.jpeg',
            ],
        ]);
    }
}
