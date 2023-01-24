<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = [
            [
                'name' => 'Цвет',
                'name_en' => 'Color',
                'options' => [
                    [
                        'name' => 'Белый',
                        'name_en' => 'White',
                    ],
                    [
                        'name' => 'Черный',
                        'name_en' => 'Black',
                    ],
                    [
                        'name' => 'Серебристый',
                        'name_en' => 'Silver',
                    ],
                    [
                        'name' => 'Золотой',
                        'name_en' => 'Gold',
                    ],
                    [
                        'name' => 'Красный',
                        'name_en' => 'Red',
                    ],
                    [
                        'name' => 'Синий',
                        'name_en' => 'Blue',
                    ],
                ],
            ],
            [
                'name' => 'Внутренняя память',
                'name_en' => 'Memory',
                'options' => [
                    [
                        'name' => '32гб',
                        'name_en' => '32',
                    ],
                    [
                        'name' => '64гб',
                        'name_en' => '64gb',
                    ],
                    [
                        'name' => '128гб',
                        'name_en' => '128gb',
                    ],
                ],
            ],
        ];

        foreach ($properties as $property) {
            $property['created_at'] = Carbon::now();
            $property['updated_at'] = Carbon::now();
            $options = $property['options'];

            unset($property['options']);

            $propertyId = DB::table('properties')->insertGetId($property);

            foreach ($options as $option) {
                $option['created_at'] = Carbon::now();
                $option['updated_at'] = Carbon::now();
                $option['property_id'] = $propertyId;

                DB::table('property_options')->insert($option);
            }
        }

        $categories = [
            [
                'name'              => 'Мобильные телефоны',
                'name_en'           => 'Mobile phones',
                'slug'              => 'mobiles',
                'description'       => 'В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!',
                'description_en'    => 'In this section you will find the most popular mobile phones at great prices!',
                'image'             => 'categories/mobiles.png',
                'products' => [
                    [
                        'name'            => 'Iphone 11',
                        'name_en'         => 'Iphone 11',
                        'slug'            => 'iphone-11',
                        'description'     => 'Великолепное устройство от Apple!',
                        'description_en'  => 'Great device from Apple!',
                        'image'           => 'products/iphone11.jpeg',
                        'new'             => 1,
                        'hit'             => 1,
                        'recommend'       => 0,
                        'properties' => [
                            1, 2
                        ],
                        'options' => [
                            [
                                1, 7,
                            ],
                            [
                                1, 8,
                            ],
                            [
                                2, 7,
                            ],
                            [
                                2, 8,
                            ],
                            [
                                3, 7,
                            ],
                            [
                                3, 8,
                            ],
                            [
                                4, 7,
                            ],
                            [
                                4, 8,
                            ],
                        ]
                    ],
                    [
                        'name'            => 'Iphone 14 Pro Max',
                        'name_en'         => 'Iphone 14 Pro Max',
                        'slug'            => 'iphone-14-pro-max',
                        'description'     => 'Умопомрочительный девайс!',
                        'description_en'  => 'Mind blowing device!',
                        'image'           => 'products/iphone14.jpg',
                        'new'             => 1,
                        'hit'             => 1,
                        'recommend'       => 0,
                        'properties' => [
                            1, 2
                        ],
                        'options' => [
                            [
                                1, 8,
                            ],
                            [
                                1, 9,
                            ],
                            [
                                2, 8,
                            ],
                            [
                                2, 9,
                            ],
                            [
                                3, 8,
                            ],
                            [
                                3, 9,
                            ],
                            [
                                4, 8,
                            ],
                            [
                                4, 9,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'              => 'Портативная техника',
                'name_en'           => 'Portable technology',
                'slug'              => 'portativnaia-texnika',
                'description'       => 'Раздел с портативной техникой.',
                'description_en'    => 'Section with portable equipment.',
                'image'             => 'categories/portativnaia-texnika.jpg',
                'products' => [
                    [
                        'name'            => 'Наушники Monster Beats',
                        'name_en'         => 'Headphones Monster Beats',
                        'slug'            => 'monster-beats',
                        'description'     => 'Качественное звучание!',
                        'description_en'  => 'Quality sound!',
                        'image'           => 'products/monster-beats.jpeg',
                        'new'             => 1,
                        'hit'             => 1,
                        'recommend'       => 1,
                        'properties' => [
                            1
                        ],
                        'options' => [
                            [
                                2, 7,
                            ],
                            [
                                2, 8,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'              => 'Бытовая техника',
                'name_en'           => 'Appliances',
                'slug'              => 'bytovaia-texnika',
                'description'       => 'В этом разделе вы найдёте самую популярную бытовую технику по отличным ценам!',
                'description_en'    => 'In this section you will find the most popular household appliances at great prices!',
                'image'             => 'categories/bytovaia-texnika.jpeg',
                'products' => [
                    [
                        'name'              => 'Стиральная машина Bosh',
                        'name_en'           => 'Bosch washing machine',
                        'slug'              => 'wash-mashin-bosh',
                        'description'       => 'Ультро мягкая стирка!',
                        'description_en'    => 'Ultra soft wash!',
                        'image'             => 'products/bosch.jpeg',
                        'new'               => 0,
                        'hit'               => 1,
                        'recommend'         => 1,
                        'properties' => [
                            1
                        ],
                        'options' => [
                            [
                                1, 7,
                            ],
                            [
                                1, 8,
                            ],
                            [
                                3, 7,
                            ],
                            [
                                3, 8,
                            ],
                            [
                                4, 7,
                            ],
                            [
                                4, 8,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($categories as $category) {
            $category['created_at'] = Carbon::now();
            $category['updated_at'] = Carbon::now();
            $products = $category['products'];

            unset($category['products']);

            $categoryId = DB::table('categories')->insertGetId($category);

            foreach ($products as $product) {
                $product['created_at'] = Carbon::now();
                $product['updated_at'] = Carbon::now();
                $product['category_id'] = $categoryId;
                $product['hit'] = rand(0, 1);
                $product['new'] = rand(0, 1);
                $product['recommend'] = rand(0, 1);

                if(isset($product['properties'])) {
                    $properties = $product['properties'];
                    unset($product['properties']);
                    $skusOptions = $product['options'];
                    unset($product['options']);
                }

                $productId = DB::table('products')->insertGetId($product);

                if(isset($properties)) {
                    foreach ($properties as $propertyId) {
                        DB::table('property_product')->insert([
                            'product_id' => $productId,
                            'property_id' => $propertyId,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }



                    foreach ($skusOptions as $skuOptions) {
                        $skuId = DB::table('skus')->insertGetId([
                            'product_id' => $productId,
                            'count'  => rand(1, 100),
                            'price' => rand(25000, 250000),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);

                        foreach ($skuOptions as $skuOption) {
                            $skuData['sku_id'] = $skuId;
                            $skuData['property_option_id'] = $skuOption;
                            $skuData['created_at'] = Carbon::now();
                            $skuData['updated_at'] = Carbon::now();


                            DB::table('sku_property_option')->insert($skuData);
                        }
                    }

                    unset($properties);
                }
            }
        }
    }
}
