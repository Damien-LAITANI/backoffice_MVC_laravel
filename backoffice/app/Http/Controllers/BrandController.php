<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends CoreController {
    public function list(Request $request)
    {
        $brands = Brand::all();

        $this->show('brand/list', [
            'brands' => $brands,
            'delete_message' => $request->session()->get('delete')
        ]);
    }

    public function add(Request $request)
    {
        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $this->show('brand/add', [
            'token' => $token,
            'errors_messages' => $errors_messages,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate( [
            'name' => 'bail|required|string|max:64|unique:brand,name'
        ],
        [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas faire plus de 64 caractères'
        ]);

        $brand = new Brand();

        $brand->name = $validated['name'];

        $isInserted = $brand->save();

        if ($isInserted) {
            return redirect('marque');
        }
        return redirect('marque/ajout');
    }

    public function edit(Request $request, $id)
    {
        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $brand = Brand::find($id);

        $this->show('brand/edit', [
            'token' => $token,
            'brand' => $brand,
            'errors_messages' => $errors_messages,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'bail|required|string|max:64'
        ],
        [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas faire plus de 64 caractères'
        ]);

        $brand = Brand::find($id);

        if ($validated['name'] !== $brand->name) {
            $brand->name = $request->name;
        }

        $isInserted = $brand->save();

        if ($isInserted) {
            return redirect('marque');
        }
        return redirect('marque/modifier/' . $id);
    }

    public function order()
    {
        $brands = Brand::all();

        $this->show('brand/order', [
            'brands' => $brands
        ]);
    }

    public function delete(Request $request, $id)
    {
        $brand = Brand::find($id);

        $isDeleted = $brand->delete();

        if ($isDeleted) {
            $request->session()->flash('delete', 'La marque <strong>' . $brand->name . '</strong> a bien été supprimée.');
           return redirect()->back();
        }
    }
}
