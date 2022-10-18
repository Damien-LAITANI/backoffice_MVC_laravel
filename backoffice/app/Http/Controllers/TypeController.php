<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TypeController extends CoreController
{
    /**
     * Méthode gérant la page affichant la liste des types
     *
     * @param Request $request
     * @return void
     */
    public function list(Request $request): void
    {
        $types = Type::all();

        $this->show('type/list', [
            'types' => $types,
            'success_message' => $request->session()->get('success'),
            'error_message' => $request->session()->get('error'),
        ]);
    }

    /**
     * Méthode gérant la page permettant d'ajouter un type
     *
     * @param Request $request
     * @return void
     * @throws AuthorizationException
     */
    public function add(Request $request): void
    {
        $this->authorize('create', Type::class);

        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $this->show('type/add', [
            'token' => $token,
            'errors_messages' => $errors_messages,
        ]);
    }

    /**
     * Méthode gérant la page recevant les données du formulaire d'ajout d'un type
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function create(Request $request): Redirector|RedirectResponse|Application
    {
        $this->authorize('create', Type::class);

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
            $request->session()->flash('success', 'Le type <strong>' . $type->name . '</strong> a bien été créé');
            return redirect('type');
        }
        return redirect('type/ajout');
    }

    /**
     * Méthode gérant la page permettant d'afficher la formulaire d'édition d'un type
     *
     * @param Request $request
     * @param int $id
     * @return void
     * @throws AuthorizationException
     */
    public function edit(Request $request, int $id): void
    {
        $this->authorize('update', Type::class);

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

    /**
     * Méthode gérant la page traitant les informations envoyées par le formulaire
     * d'édition d'un type
     *
     * @param Request $request
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, int $id): Redirector|RedirectResponse|Application
    {
        $this->authorize('update', Type::class);

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
            $request->session()->flash('success', 'Le type <strong>' . $type->name . '</strong> a bien été mis à jour');
            return redirect('type');
        }
        return redirect('type/modifier/' . $id);
    }

    /**
     * Méthode gérant la suppression d'un type
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function delete(Request $request, $id): RedirectResponse
    {
        $this->authorize('delete', Type::class);

        $type = Type::find($id);

        $isDeleted = $type->delete();

        if ($isDeleted) {
            $request->session()->flash('success', 'Le type <strong>' . $type->name . '</strong> a bien été supprimé');
           return redirect()->back();
        }
        $request->session()->flash('error', 'Le type <strong>' . $type->name . '</strong> n\'a pas pu être supprimé');
        return redirect()->back();
    }
}
