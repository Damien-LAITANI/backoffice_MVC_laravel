<?php

namespace App\Http\Controllers;

class CoreController extends Controller {
    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewData = [])
    {

        $viewData['currentPage'] = $viewName;

        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewData);

        require_once __DIR__ . '/../../../resources/views/layout/header.tpl.php';
        require_once __DIR__ . '/../../../resources/views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../../../resources/views/layout/footer.tpl.php';
    }
}
