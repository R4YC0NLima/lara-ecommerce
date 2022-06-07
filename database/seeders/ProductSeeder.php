<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'          => 'Papelaria',
                'description'   => 'teste'
            ],
            [
                'name'          => 'Comida',
                'description'   => 'teste'
            ]
        ];

        $category = Category::insert($categories);

        $products = [
            [
                'name'          => 'Produto 1',
                'price'         => '2.20',
                'description'   => 'teste',
                'category_id'   => array_rand($category->id)
            ],
            [
                'name'          => 'Produto 2',
                'price'         => '2.50',
                'description'   => 'teste',
                'category_id'   => array_rand($category->id)
            ],
            [
                'name'          => 'Produto 3',
                'price'         => '3.20',
                'description'   => 'teste',
                'category_id'   => array_rand($category->id)
            ],
            [
                'name'          => 'Produto 4',
                'price'         => '3.50',
                'description'   => 'teste',
                'category_id'   => array_rand($category->id)
            ],
            [
                'name'          => 'Produto 5',
                'price'         => '5.20',
                'description'   => 'teste',
                'category_id'   => array_rand($category->id)
            ],
            [
                'name'          => 'Produto 6',
                'price'         => '7.20',
                'description'   => 'teste',
                'category_id'   => array_rand($category->id)
            ],
            [
                'name'          => 'Produto 7',
                'price'         => '12.20',
                'description'   => 'teste',
                'category_id'   => array_rand($category->id)
            ],
            [
                'name'          => 'Produto 8',
                'price'         => '21.20',
                'description'   => 'teste',
                'category_id'   => array_rand($category->id)
            ],
            [
                'name'          => 'Produto 9',
                'price'         => '27.20',
                'description'   => 'teste',
                'category_id'   => array_rand($category->id)
            ],
            [
                'name'          => 'Produto 10',
                'price'         => '22.20',
                'description'   => 'teste',
                'category_id'   => array_rand($category->id)
            ],
        ];

        Product::insert($products);
    }
}
