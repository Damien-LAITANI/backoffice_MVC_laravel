<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class BrandController extends CoreController
{
    /**
     * Méthode gérant la page affichant la liste des marques
     *
     * @param Request $request
     * @return void
     */
    public function list(Request $request): void
    {
        $brands = Brand::all();

        $this->show('brand/list', [
            'brands' => $brands,
            'success_message' => $request->session()->get('success'),
            'error_message' => $request->session()->get('error'),
        ]);
    }

    /**
     * Méthode gérant la page permettant d'ajouter une marque
     *
     * @param Request $request
     * @throws AuthorizationException
     * @return void
     */
    public function add(Request $request): void
    {
        $this->authorize('create', Brand::class);

        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $this->show('brand/add', [
            'token' => $token,
            'errors_messages' => $errors_messages,
        ]);
    }

    /**
     * Méthode gérant la page recevant les données du formulaire d'ajout d'une marque
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function create(Request $request): Redirector|RedirectResponse|Application
    {
        $this->authorize('create', Brand::class);

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
            $request->session()->flash('success', 'La marque <strong>' . $brand->name . '</strong> a bien été créée');
            return redirect('marque');
        }
        return redirect('marque/ajout');
    }

    /**
     * Méthode gérant la page permettant d'afficher la formulaire d'édition d'une marque
     *
     * @param Request $request
     * @param int $id
     * @return void
     * @throws AuthorizationException
     */
    public function edit(Request $request, int $id): void
    {
        $this->authorize('update', Brand::class);

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

    /**
     * Méthode gérant la page traitant les informations envoyées par le formulaire
     * d'édition d'une marque
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(Request $request, int $id): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', Brand::class);

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
            $request->session()->flash('success', 'La marque <strong>' . $brand->name . '</strong> a bien été mise à jour');
            return redirect('marque');
        }
        return redirect('marque/modifier/' . $id);
    }

    /**
     * Méthode gérant la suppression d'une marque
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function delete(Request $request, int $id): RedirectResponse
    {
        $this->authorize('delete', Brand::class);

        $brand = Brand::find($id);

        $isDeleted = $brand->delete();

        if ($isDeleted) {
            $request->session()->flash('success', 'La marque <strong>' . $brand->name . '</strong> a bien été supprimée');
           return redirect()->back();
        }
        $request->session()->flash('error', 'La marque <strong>' . $brand->name . '</strong> n\'a pas pu être supprimée');
        return redirect()->back();
    }
}
