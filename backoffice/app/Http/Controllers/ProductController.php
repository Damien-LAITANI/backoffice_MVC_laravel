<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends CoreController
{
    public function list()
    {
        $products = Product::all();

        $this->show('product/list', [
            'products' => $products
        ]);
    }

    public function add(Request $request)
    {
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $token = csrf_token();
        $categories = Category::all();
        $brands = Brand::all();
        $types = Type::all();

        $this->show('product/add', [
            'categories' => $categories,
            'brands' => $brands,
            'types' => $types,
            'token' => $token,
            'errors_messages' => $errors_messages
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'bail|required|string|max:64|unique:category,name',
            'description' => 'string|required|min:3|max:64|nullable',
            'picture' => 'string|max:128|nullable',
            'price' => 'required|numeric|digits_between:1,5',
            'rate' => 'required|numeric|max:5',
            'status' => 'required|numeric|max:2',
            'category' => 'required|numeric|max:128',
            'brand' => 'required|numeric|max:128',
            'type' => 'required|numeric|max:128'
        ],
        [
            'required' => 'Le :attribute est requis',
            'numeric' => 'Le :attribute doit être un nombre',
            'status.max' => 'La disponibilité doit être comprise entre 1 et 2',
            'rate.max' => 'La note doit être comprise entre 1 et 5',
            'price.digits_between' => 'Le prix doit faire entre 1 et 5 chiffres',
        ]);

        $product = new Product();

        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->picture = $validated['picture'];
        $product->price = $validated['price'];
        $product->rate = $validated['rate'];
        $product->status = $validated['status'];
        $product->category_id = $validated['category'];
        $product->brand_id = $validated['brand'];
        $product->type_id = $validated['type'];

        $isInserted = $product->save();

        if ($isInserted) {
            return redirect('produit');
        }
        return redirect('produit/ajout');
    }

    public function edit($id)
    {
        $product = Product::find($id)->load('category')->load('brand')->load('type');
        $categories = Category::all();
        $brands = Brand::all();
        $types = Type::all();

        $this->show('product/edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'types' => $types
        ]);

    }
}
