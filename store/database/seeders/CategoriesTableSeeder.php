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
                'name'        => 'Мобильные телефоны',
                'slug'        => 'mobiles',
                'description' => 'В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!'
            ],
            [
                'name'        => 'Портативная техника',
                'slug'        => 'portativnaia-texnika',
                'description' => 'Раздел с портативной техникой.'
            ],
            [
                'name'        => 'Бытовая техника',
                'slug'        => 'bytovaia-texnika',
                'description' => 'В этом разделе вы найдёте самую популярную бытовую технику по отличным ценам!'
            ],
        ]);
    }
}
