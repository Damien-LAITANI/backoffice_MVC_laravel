<div class="container my-4">
    <a href="<?= route('category-list') ?>" class="btn btn-success float-end">Retour</a>
    <h2>Mettre à jour une catégorie</h2>

    <form action="<?= route('category-update', ['id' => $category->id]) ?>" method="POST" class="mt-5">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nom de la catégorie" value="<?= old('name') ?? $category->name ?>">
            <p class="text-danger"><?= $errors_messages['name'][0] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="subtitle" class="form-label">Sous-titre</label>
            <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Sous-titre" aria-describedby="subtitleHelpBlock" value="<?= old('subtitle') ?? $category->subtitle ?>">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Sera affiché sur la page d'accueil comme bouton devant l'image
            </small>
            <p class="text-danger"><?= $errors_messages['subtitle'][0] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Image</label>
            <input type="text" name="picture" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?= old('picture') ?? $category->picture ?>">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png)
            </small>
            <p class="text-danger"><?= $errors_messages['picture'][0] ?? '' ?></p>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-5">Valider</button>
        </div>
    </form>
</div>
