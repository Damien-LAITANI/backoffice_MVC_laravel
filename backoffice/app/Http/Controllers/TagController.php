<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TagController extends CoreController
{
    /**
     * Méthode gérant la page affichant la liste des tags
     *
     * @param Request $request
     * @return void
     */
    public function list(Request $request): void
    {
        $tags = Tag::all();

        $this->show('tag/list', [
            'tags' => $tags,
            'success_message' => $request->session()->get('success')
        ]);
    }

    /**
     * Méthode gérant la page permettant d'ajouter un tag
     *
     * @param Request $request
     * @return void
     * @throws AuthorizationException
     */
    public function add(Request $request): void
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

    /**
     * Méthode gérant la page recevant les données du formulaire d'ajout d'un tag
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function create(Request $request): Redirector|RedirectResponse|Application
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
            $request->session()->flash('success', 'Le tag <strong>' . $tag->name . '</strong> a bien été créé');
            return redirect('tag');
        }
        return redirect('tag/ajout');
    }

    /**
     * Méthode gérant la page permettant d'afficher la formulaire d'édition d'un tag
     *
     * @param Request $request
     * @param int $id
     * @return void
     * @throws AuthorizationException
     */
    public function edit(Request $request, int $id): void
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

    /**
     * Méthode gérant la page traitant les informations envoyées par le formulaire
     * d'édition d'un tag
     *
     * @param Request $request
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, int $id): Redirector|RedirectResponse|Application
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
            $request->session()->flash('success', 'Le tag <strong>' . $tag->name . '</strong> a bien été mis à jour');
            return redirect('tag');
        }
        return redirect('tag/modifier/' . $id);
    }

    /**
     * Méthode gérant la suppression d'un tag
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function delete(Request $request, int $id): RedirectResponse
    {
        $this->authorize('delete', Tag::class);

        $tag = Tag::find($id);

        $isDeleted = $tag->delete();

        if ($isDeleted) {
            $request->session()->flash('success', 'Le tag <strong>' . $tag->name . '</strong> a bien été supprimé');
           return redirect()->back();
        }
    }
}
