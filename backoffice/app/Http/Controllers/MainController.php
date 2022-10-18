<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;

class MainController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home(): void
    {
        $products = Product::all()->take(5)->load('brand')->load('tag');
        $categories = Category::all()->take(5);
        $tags = Tag::all();
        $this->show('main/home', [
            'products' => $products,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
