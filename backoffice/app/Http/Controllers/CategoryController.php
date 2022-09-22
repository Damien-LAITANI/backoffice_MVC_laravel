<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\ValidatedInput;
use Mockery\Undefined;

class CategoryController extends CoreController {
    public function list()
    {
        $categories = Category::all();
        $this->show('category/list', [
            'categories' => $categories,
        ]);
    }

    public function add(Request $request)
    {
        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des input et les messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $old_inputs = isset($request->session()->all()['_old_input']) ? $request->session()->get('_old_input') : null;
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $this->show('category/add', [
            'token' => $token,
            'old_inputs' => $old_inputs,
            'errors_messages' => $errors_messages,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'bail|required|string|max:64|unique:category,name',
            'subtitle' => 'string|required|min:3|max:64|nullable',
            'picture' => 'string|max:128|nullable'
        ]);

        $category = new Category();

        $category->name = $validated['name'];
        $category->subtitle = $validated['subtitle'];
        $category->picture = $validated['picture'];

        $isInserted = $category->save();

        if ($isInserted) {
            return redirect('categorie');
        }
        return redirect('categorie/ajout');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $this->show('category/edit', [
            'category' => $category
        ]);
    }

    public function order()
    {
        $categories = Category::all();
        $this->show('category/order', [
            'categories' => $categories
        ]);
    }
}
