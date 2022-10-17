<?php

use Illuminate\Support\Facades\Auth;
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= Auth::check() ? Route('home') : Route('authentication')?>">Bedacier</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php if(Auth::check()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'main/home' ? 'active' : '' ?>" href="<?= Route('home') ?>">Accueil <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'category/list' ? 'active' : '' ?>" href="<?= route('category-list') ?>">Catégories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'product/list' ? 'active' : '' ?>" href="<?= route('product-list') ?>">Produits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'type/list' ? 'active' : '' ?>" href="<?= route('type-list') ?>">Types</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'brand/list' ? 'active' : '' ?>" href="<?= route('brand-list') ?>">Marques</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'tag/list' ? 'active' : '' ?>" href="<?= route('tag-list') ?>">Tags</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'category/order' ? 'active' : '' ?>" href="<?= route('category-order') ?>">Sélections Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('logout') ?>">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'user/authentication' ? 'active' : '' ?>" href="<?= route('authentication') ?>">Connexion</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
