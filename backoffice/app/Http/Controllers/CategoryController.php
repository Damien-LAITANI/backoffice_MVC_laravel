<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends CoreController {
    public function list(Request $request)
    {
        $categories = Category::all();
        $this->show('category/list', [
            'categories' => $categories,
            'delete_message' => $request->session()->get('delete')
        ]);
    }

    public function add(Request $request)
    {
        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $this->show('category/add', [
            'token' => $token,
            'errors_messages' => $errors_messages,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate( [
            'name' => 'bail|required|string|max:64|unique:category,name',
            'subtitle' => 'string|required|min:3|max:64|nullable',
            'picture' => 'string|max:128|nullable'
        ],
        [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas faire plus de 64 caractères',
            'subtitle.required' => 'Le sous-titre est requis',
            'subtitle.min' => 'Le sous-titre doit faire au moins 3 caractères',
            'subtitle.max' => 'Le sous-titre ne doit pas faire plus de 64 caractères',
            'picture.max' => 'L\'url de l\'image ne doit pas faire plus de 128 caractères',
        ]);
        // d($validated);die;
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

    public function edit(Request $request, $id)
    {
        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $category = Category::find($id);

        $this->show('category/edit', [
            'token' => $token,
            'category' => $category,
            'errors_messages' => $errors_messages,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'bail|required|string|max:64',
            'subtitle' => 'string|required|min:3|max:64|nullable',
            'picture' => 'string|max:128|nullable'
        ],
        [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas faire plus de 64 caractères',
            'subtitle.required' => 'Le sous-titre est requis',
            'subtitle.min' => 'Le sous-titre doit faire au moins 3 caractères',
            'subtitle.max' => 'Le sous-titre ne doit pas faire plus de 64 caractères',
            'picture.max' => 'L\'url de l\'image ne doit pas faire plus de 128 caractères',
        ]);

        $category = Category::find($id);

        if ($validated['name'] !== $category->name) {
            $category->name = $request->name;
        }

        if ($validated['subtitle'] !== $category->subtitle) {
            $category->subtitle = $request->subtitle;
        }

        if ($request->filled('picture') && $validated['picture'] !== $category->picture) {
            $category->picture = $request->picture;
        }

        $isInserted = $category->save();

        if ($isInserted) {
            return redirect('categorie');
        }
        return redirect('categorie/modifier/' . $id);
    }

    public function order()
    {
        $categories = Category::all();
        $this->show('category/order', [
            'categories' => $categories
        ]);
    }

    public function delete(Request $request, $id)
    {
        $category = Category::find($id);

        $isDeleted = $category->delete();

        if ($isDeleted) {
            $request->session()->flash('delete', 'La catégorie <strong>' . $category->name . '</strong> a bien été supprimée.');
           return redirect()->back();
        }
    }
}
