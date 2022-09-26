<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class ProductController extends CoreController
{
    public function list()
    {
        $products = Product::all();

        $this->show('product/list', [
            'products' => $products
        ]);
    }

    public function add()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $types = Type::all();

        $this->show('product/add', [
            'categories' => $categories,
            'brands' => $brands,
            'types' => $types
        ]);
    }
}
