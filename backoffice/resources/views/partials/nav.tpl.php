
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">oShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= Route('home') ?>">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <?php if(!isset($_SESSION['connectedUser'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Utilisateurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('category-list') ?>">Catégories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Produits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('type-list') ?>">Types</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('brand-list') ?>">Marques</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('tag-list') ?>">Tags</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('category-order') ?>">Sélections Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Deconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Connexion</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
