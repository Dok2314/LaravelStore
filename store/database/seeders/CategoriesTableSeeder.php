<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name'              => 'Мобильные телефоны',
                'name_en'           => 'Mobile phones',
                'slug'              => 'mobiles',
                'description'       => 'В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!',
                'description_en'    => 'In this section you will find the most popular mobile phones at great prices!',
                'image'             => 'categories/mobiles.png',
            ],
            [
                'name'              => 'Портативная техника',
                'name_en'           => 'Portable technology',
                'slug'              => 'portativnaia-texnika',
                'description'       => 'Раздел с портативной техникой.',
                'description_en'    => 'Section with portable equipment.',
                'image'             => 'categories/portativnaia-texnika.jpg',
            ],
            [
                'name'              => 'Бытовая техника',
                'name_en'           => 'Appliances',
                'slug'              => 'bytovaia-texnika',
                'description'       => 'В этом разделе вы найдёте самую популярную бытовую технику по отличным ценам!',
                'description_en'    => 'In this section you will find the most popular household appliances at great prices!',
                'image'             => 'categories/bytovaia-texnika.jpeg',
            ],
        ]);
    }
}
