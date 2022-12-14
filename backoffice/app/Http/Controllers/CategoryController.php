<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CategoryController extends CoreController
{
    /**
     * Méthode gérant la page affichant la liste des catégories
     *
     * @param Request $request
     * @return void
     */
    public function list(Request $request): void
    {
        $categories = Category::all();
        $this->show('category/list', [
            'categories' => $categories,
            'success_message' => $request->session()->get('success'),
            'error_message' => $request->session()->get('error'),
        ]);
    }

    /**
     * Méthode gérant la page permettant d'ajouter une catégorie
     *
     * @param Request $request
     * @return void
     * @throws AuthorizationException
     */
    public function add(Request $request): void
    {
        $this->authorize('create', Category::class);

        $token = csrf_token();

        // En cas d'erreur on récupère les valeurs des messages dans la session
        // On crée une condition avec isset(), pour éviter une erreur php s'il ne trouve pas se qu'il cherche
        $errors_messages = isset($request->session()->all()['errors']) ? $request->session()->get('errors')->getMessages() : null;

        $this->show('category/add', [
            'token' => $token,
            'errors_messages' => $errors_messages,
        ]);
    }

    /**
     * Méthode gérant la page recevant les données du formulaire d'ajout d'une catégorie
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function create(Request $request): Redirector|RedirectResponse|Application
    {
        $this->authorize('create', Category::class);

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
            $request->session()->flash('success', 'La catégorie <strong>' . $category->name . '</strong> a bien été créée');
            return redirect('categorie');
        }
        return redirect('categorie/ajout');
    }

    /**
     * Méthode gérant la page permettant d'afficher la formulaire d'édition d'une catégorie
     *
     * @param Request $request
     * @param int $id
     * @return void
     * @throws AuthorizationException
     */
    public function edit(Request $request, int $id): void
    {
        $this->authorize('update', Category::class);

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

    /**
     * Méthode gérant la page traitant les informations envoyées par le formulaire
     * d'édition d'une catégorie
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(Request $request, int $id): Redirector|RedirectResponse|Application
    {
        $this->authorize('update', Category::class);

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
            $request->session()->flash('success', 'La catégorie <strong>' . $category->name . '</strong> a bien été mise à jour');
            return redirect('categorie');
        }
        return redirect('categorie/modifier/' . $id);
    }

    /**
     * Méthode gérant la page affichant le formulaire
     * de sélection des catégories mises en avant sur
     * la page d'accueil Front
     *
     * @param Request $request
     * @return void
     * @throws AuthorizationException
     */
    public function order(Request $request): void
    {
        $categories = Category::all();
        $categoriesOrderByHomePage = Category::where('home_order', '>', 0)->orderBy('home_order', 'asc')->get()->all();

        $this->show('category/order', [
            'categories' => $categories,
            'categoriesOrderByHomePage' => $categoriesOrderByHomePage,
            'error_message' => $request->session()->get('error'),
            'success_message' => $request->session()->get('success'),
        ]);
    }

    /**
     * Méthode gérant la soumission du formulaire de choix
     * des catégories mises en avant sur la page d'accueil
     * du site Front
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function updateOrder(Request $request): Redirector|RedirectResponse|Application
    {
        $validated = $request->validate([
            'location' => 'bail|required|array:1,2,3,4,5|size:5',
        ],
        [
            'name.required' => 'Les emplacements sont requis',
        ]);
        $validated['location'] = array_unique($validated['location']);

        if (sizeof($validated['location']) === 5) {
            $categories = Category::all();

            foreach ($categories as $category) {
                $newHomeOrder = array_search($category->id, $validated['location']);
                if ($newHomeOrder) {
                    $category->home_order = $newHomeOrder;
                } else {
                    if ($category->home_order !== 0) {
                        $category->home_order = 0;
                    }
                }
                $isUpdated = $category->save();
                if ($isUpdated) {
                    $request->session()->flash('success', 'L\'ordre des catégories a été mis à jour');
                } else {
                    $request->session()->flash('error', 'L\'ordre des catégories n\'a pas pu être modifier');
                }
            }
        } else {
            $request->session()->flash('error', 'Des emplacements contiennent les mêmes catégories');
        }
        return redirect('categorie/ordre');
    }

    /**
     * Méthode gérant la suppression d'une catégorie
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function delete(Request $request, int $id): RedirectResponse
    {
        $this->authorize('delete', Category::class);

        $category = Category::find($id);

        $isDeleted = $category->delete();

        if ($isDeleted) {
            $request->session()->flash('success', 'La catégorie <strong>' . $category->name . '</strong> a bien été supprimée');
           return redirect()->back();
        }
        $request->session()->flash('error', 'La catégorie <strong>' . $category->name . '</strong> n\'a pas pu être supprimée');
        return redirect()->back();
    }
}
