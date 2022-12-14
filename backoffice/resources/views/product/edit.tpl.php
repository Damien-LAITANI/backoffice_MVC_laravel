<div class="container my-4">
    <a href="<?= route('product-list') ?>" class="btn btn-success float-end">Retour</a>
    <h2>Mettre à jour un produit</h2>

    <form action="<?= route('product-update', ['id' => $product->id]) ?>" method="POST" class="mt-5">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nom du produit" value="<?= old('name') ?? $product->name ?>">
            <p class="text-danger"><?= $errors_messages['name'][0] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" class="form-control" id="description" placeholder="Description" aria-describedby="subtitleHelpBlock" value="<?= old('description') ?? $product->description ?>">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Sera affiché sur la page d'accueil comme bouton devant l'image
            </small>
            <p class="text-danger"><?= $errors_messages['description'][0] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Image</label>
            <input type="text" name="picture" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?= old('picture') ?? $product->picture ?>">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png)
            </small>
            <p class="text-danger"><?= $errors_messages['picture'][0] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="0" value="<?= old('price') ?? $product->price ?>">
            <p class="text-danger"><?= $errors_messages['price'][0] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Note</label>
            <input type="number" name="rate" class="form-control" id="rate" placeholder="0" value="<?= old('rate') ?? $product->rate ?>">
            <p class="text-danger"><?= $errors_messages['rate'][0] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Disponibilité</label>
            <input type="number" name="status" class="form-control" id="status" placeholder="1" value="<?= old('status') ?? $product->status ?>">
            <p class="text-danger"><?= $errors_messages['status'][0] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Categorie</label>
            <select name="category" id="category" class="form-control">
                    <option value="">------</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?= $category->id ?>"<?= (isset($product->category) && $product->category->name === $category->name) ? 'selected' : '' ?>><?= $category->name ?></option>
                    <?php endforeach; ?>
            </select>
            <p class="text-danger"><?= $errors_messages['category'][0] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="brand" class="form-label">Marque</label>
            <select name="brand" id="brand" class="form-control">
                    <option value="">------</option>
                    <?php foreach($brands as $brand): ?>
                        <option value="<?= $brand->id ?>" <?= (isset($product->brand) && $product->brand->name === $brand->name) ? 'selected' : '' ?>><?= $brand->name ?></option>
                    <?php endforeach; ?>
            </select>
            <p class="text-danger"><?= $errors_messages['brand'][0] ?? '' ?></p>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Types</label>
            <select name="type" id="type" class="form-control">
                    <option value="">------</option>
                    <?php foreach($types as $type): ?>
                        <option value="<?= $type->id ?>" <?= (isset($product->type) && $product->type->name === $type->name) ? 'selected' : '' ?>><?= $type->name ?></option>
                    <?php endforeach; ?>
            </select>
            <p class="text-danger"><?= $errors_messages['type'][0] ?? '' ?></p>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-5">Valider</button>
        </div>
    </form>
</div>
