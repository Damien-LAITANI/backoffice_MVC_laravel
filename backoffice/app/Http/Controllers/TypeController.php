<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends CoreController {
    public function list(Request $request)
    {
        $types = Type::all();

        $this->show('type/list', [
            'types' => $types,
            'delete_message' => $request->session()->get('delete')
        ]);
    }

    public function add(Request $request)
    {
        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $this->show('type/add', [
            'token' => $token,
            'errors_messages' => $errors_messages,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate( [
            'name' => 'bail|required|string|max:64|unique:type,name'
        ],
        [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas faire plus de 64 caractères'
        ]);

        $type = new Type();

        $type->name = $validated['name'];

        $isInserted = $type->save();

        if ($isInserted) {
            return redirect('type');
        }
        return redirect('type/ajout');
    }

    public function edit(Request $request, $id)
    {
        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $type = Type::find($id);

        $this->show('type/edit', [
            'token' => $token,
            'type' => $type,
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

        $type = Type::find($id);

        if ($validated['name'] !== $type->name) {
            $type->name = $request->name;
        }

        $isInserted = $type->save();

        if ($isInserted) {
            return redirect('type');
        }
        return redirect('type/modifier/' . $id);
    }

    public function delete(Request $request, $id)
    {
        $type = Type::find($id);

        $isDeleted = $type->delete();

        if ($isDeleted) {
            $request->session()->flash('delete', 'Le type <strong>' . $type->name . '</strong> a bien été supprimé.');
           return redirect()->back();
        }
    }
}
