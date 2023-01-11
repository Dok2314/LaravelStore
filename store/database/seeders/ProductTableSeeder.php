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
               'count'        => 10,
               'category_id'  => 1,
               'image'        => 'products/iphone11.jpeg',
               'new'          => 1,
               'hit'          => 1,
               'recommend'    => 0,
           ],
            [
                'name'         => 'Iphone 14 Pro Max',
                'slug'         => 'iphone-14-pro-max',
                'description'  => 'Умопомрочительный девайс!',
                'price'        => '155000',
                'count'        => 5,
                'category_id'  => 1,
                'image'        => 'products/iphone14.jpg',
                'new'          => 1,
                'hit'          => 1,
                'recommend'    => 0,
            ],
            [
                'name'         => 'Наушники Monster Beats',
                'slug'         => 'monster-beats',
                'description'  => 'Качественное звучание!',
                'price'        => '49000',
                'count'        => 10,
                'category_id'  => 2,
                'image'        => 'products/monster-beats.jpeg',
                'new'          => 1,
                'hit'          => 1,
                'recommend'    => 1,
            ],
            [
                'name'         => 'Стиральная машина Bosh',
                'slug'         => 'wash-mashin-bosh',
                'description'  => 'Ультро мягкая стирка!',
                'price'        => '35000',
                'count'        => 5,
                'category_id'  => 3,
                'image'        => 'products/bosch.jpeg',
                'new'          => 0,
                'hit'          => 1,
                'recommend'    => 1
            ],
        ]);
    }
}
