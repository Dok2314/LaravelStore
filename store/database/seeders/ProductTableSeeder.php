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
               'name'            => 'Iphone 11',
               'name_en'         => 'Iphone 11',
               'slug'            => 'iphone-11',
               'description'     => 'Великолепное устройство от Apple!',
               'description_en'  => 'Great device from Apple!',
               'category_id'     => 1,
               'image'           => 'products/iphone11.jpeg',
               'new'             => 1,
               'hit'             => 1,
               'recommend'       => 0,
           ],
            [
                'name'            => 'Iphone 14 Pro Max',
                'name_en'         => 'Iphone 14 Pro Max',
                'slug'            => 'iphone-14-pro-max',
                'description'     => 'Умопомрочительный девайс!',
                'description_en'  => 'Mind blowing device!',
                'category_id'     => 1,
                'image'           => 'products/iphone14.jpg',
                'new'             => 1,
                'hit'             => 1,
                'recommend'       => 0,
            ],
            [
                'name'            => 'Наушники Monster Beats',
                'name_en'         => 'Headphones Monster Beats',
                'slug'            => 'monster-beats',
                'description'     => 'Качественное звучание!',
                'description_en'  => 'Quality sound!',
                'category_id'     => 2,
                'image'           => 'products/monster-beats.jpeg',
                'new'             => 1,
                'hit'             => 1,
                'recommend'       => 1,
            ],
            [
                'name'              => 'Стиральная машина Bosh',
                'name_en'           => 'Bosch washing machine',
                'slug'              => 'wash-mashin-bosh',
                'description'       => 'Ультро мягкая стирка!',
                'description_en'    => 'Ultra soft wash!',
                'category_id'       => 3,
                'image'             => 'products/bosch.jpeg',
                'new'               => 0,
                'hit'               => 1,
                'recommend'         => 1,
            ],
        ]);
    }
}
