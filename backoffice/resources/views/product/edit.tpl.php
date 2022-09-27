<div class="container my-4">
    <a href="<?= route('product-list') ?>" class="btn btn-success float-end">Retour</a>
    <h2>Mettre à jour un produit</h2>

    <form action="" method="POST" class="mt-5">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nom du produit" value="<?= $product->name ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" class="form-control" id="description" placeholder="Description" aria-describedby="subtitleHelpBlock" value="<?= $product->discription ?>">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Sera affiché sur la page d'accueil comme bouton devant l'image
            </small>
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Image</label>
            <input type="text" name="picture" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?= $product->picture ?>">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="0" value="<?= $product->price ?>">
        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Note</label>
            <input type="number" name="rate" class="form-control" id="rate" placeholder="0" value="<?= $product->rate ?>">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Disponibilité</label>
            <input type="number" name="status" class="form-control" id="status" placeholder="1" value="<?= $product->status ?>">
        </div>

        <!-- Select pour categories -->
        <div class="mb-3">
            <label for="category" class="form-label">Categorie</label>
            <select name="category" id="category" class="form-control">
                    <option value="">------</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?= $category->id ?>"<?= $product->category->name === $category->name ? 'selected' : '' ?>><?= $category->name ?></option>
                    <?php endforeach; ?>
            </select>
        </div>

        <!-- Select pour marques -->
        <div class="mb-3">
            <label for="brand" class="form-label">Marque</label>
            <select name="brand" id="brand" class="form-control">
                    <option value="">------</option>
                    <?php foreach($brands as $brand): ?>
                        <option value="<?= $brand->id ?>" <?= $product->brand->name === $brand->name ? 'selected' : '' ?>><?= $brand->name ?></option>
                    <?php endforeach; ?>
            </select>
        </div>

        <!-- Select pour types -->
        <div class="mb-3">
            <label for="type" class="form-label">Types</label>
            <select name="type" id="type" class="form-control">
                    <option value="">------</option>
                    <?php foreach($types as $type): ?>
                        <option value="<?= $type->id ?>" <?= $product->type->name === $type->name ? 'selected' : '' ?>><?= $type->name ?></option>
                    <?php endforeach; ?>
            </select>
        </div>


        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-5">Valider</button>
        </div>
    </form>
</div>
