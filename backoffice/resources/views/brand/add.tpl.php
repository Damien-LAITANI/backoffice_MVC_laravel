<div class="container my-4">
    <a href="<?= Route('brand-list') ?>" class="btn btn-success float-end">Retour</a>
    <h2>Ajouter une marque</h2>

    <form action="<?= route('brand-create') ?>" method="POST" class="mt-5">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nom de la marque" value="<?= old('name') ?>">
            <p class="text-danger"><?= $errors_messages['name'][0] ?? '' ?></p>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-5">Valider</button>
        </div>
    </form>
</div>
