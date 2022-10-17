<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends CoreController
{
    public function list(Request $request)
    {
        $products = Product::all();

        $this->show('product/list', [
            'products' => $products,
            'success_message' => $request->session()->get('success')
        ]);
    }

    public function add(Request $request)
    {
        $this->authorize('create', Product::class);
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
        $this->authorize('create', Product::class);
        $validated = $request->validate([
            'name' => 'bail|required|string|max:64|unique:category,name',
            'description' => 'string|required|min:3|max:255|nullable',
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
            $request->session()->flash('success', 'Le produit <strong>' . $product->name . '</strong> a bien été créé');
            return redirect('produit');
        }
        return redirect('produit/ajout');
    }

    public function edit(Request $request,$id)
    {
        $this->authorize('update', Product::class);
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $product = Product::find($id)->load('category')->load('brand')->load('type');
        $categories = Category::all();
        $brands = Brand::all();
        $types = Type::all();
        $this->show('product/edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'types' => $types,
            'errors_messages' => $errors_messages
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Product::class);
        $validated = $request->validate([
            'name' => 'bail|required|string|max:64|unique:category,name',
            'description' => 'string|required|min:3|max:255|nullable',
            'picture' => 'string|max:128|nullable',
            'price' => 'required|numeric',
            'rate' => 'required|numeric|max:5',
            'status' => 'required|numeric|max:2',
            'category' => 'required|numeric|max:'.sizeof(Category::all()),
            'brand' => 'required|numeric|max:'.sizeof(Brand::all()),
            'type' => 'required|numeric|max:'.sizeof(Type::all())
        ],
        [
            'required' => 'Le :attribute est requis',
            'numeric' => 'Le :attribute doit être un nombre',
            'status.max' => 'La disponibilité doit être comprise entre 1 et 2',
            'rate.max' => 'La note doit être comprise entre 1 et 5',
            'category.max' => 'La catégorie choisie ne fait pas partie des '.sizeof(Category::all()). ' catégories disponible',
            'brand.max' => 'La marque choisie ne fait pas partie des '.sizeof(Brand::all()). ' marques disponible',
            'type.max' => 'Le type choisie ne fait pas partie des '.sizeof(Type::all()). ' types disponible',
        ]);

        $product = Product::find($id);

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
            $request->session()->flash('success', 'Le produit <strong>' . $product->name . '</strong> a bien été mis à jour');
            return redirect('produit');
        }
        return redirect('produit/modifier/' . $id);
    }

    public function delete(Request $request, $id)
    {
        $this->authorize('delete', Product::class);

        $product = Product::find($id);

        $isDeleted = $product->delete();

        if ($isDeleted) {
            $request->session()->flash('success', 'Le produit <strong>' . $product->name . '</strong> a bien été supprimé');
            return redirect()->back();
        }
    }
}
