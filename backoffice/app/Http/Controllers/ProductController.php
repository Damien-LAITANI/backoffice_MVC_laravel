<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use App\Models\Product;

class ProductController extends CoreController
{
    public function list()
    {
        $products = Product::all();

        $this->show('product/list', [
            'products' => $products
        ]);
    }
}
