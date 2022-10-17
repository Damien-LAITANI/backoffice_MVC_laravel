<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends CoreController {
    public function list(Request $request)
    {
        $tags = Tag::all();

        $this->show('tag/list', [
            'tags' => $tags,
            'delete_message' => $request->session()->get('delete')
        ]);
    }

    public function add(Request $request)
    {
        $this->authorize('create', Tag::class);

        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $this->show('tag/add', [
            'token' => $token,
            'errors_messages' => $errors_messages,
        ]);
    }

    public function create(Request $request)
    {
        $this->authorize('create', Tag::class);

        $validated = $request->validate( [
            'name' => 'bail|required|string|max:64|unique:tag,name'
        ],
        [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas faire plus de 64 caractères'
        ]);

        $tag = new Tag();

        $tag->name = $validated['name'];

        $isInserted = $tag->save();

        if ($isInserted) {
            return redirect('tag');
        }
        return redirect('tag/ajout');
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('update', Tag::class);

        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $tag = Tag::find($id);

        $this->show('tag/edit', [
            'token' => $token,
            'tag' => $tag,
            'errors_messages' => $errors_messages,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Tag::class);

        $validated = $request->validate([
            'name' => 'bail|required|string|max:64'
        ],
        [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas faire plus de 64 caractères'
        ]);

        $tag = Tag::find($id);

        if ($validated['name'] !== $tag->name) {
            $tag->name = $request->name;
        }

        $isInserted = $tag->save();

        if ($isInserted) {
            return redirect('tag');
        }
        return redirect('tag/modifier/' . $id);
    }

    public function delete(Request $request, $id)
    {
        $this->authorize('delete', Tag::class);

        $tag = Tag::find($id);

        $isDeleted = $tag->delete();

        if ($isDeleted) {
            $request->session()->flash('delete', 'Le tag <strong>' . $tag->name . '</strong> a bien été supprimé.');
           return redirect()->back();
        }
    }
}
