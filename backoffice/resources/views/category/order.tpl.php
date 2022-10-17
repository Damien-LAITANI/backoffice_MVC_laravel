<div class="container my-4">
    <p class="bg-danger <?= isset($error_message) ?  'p-2 text-white' : '' ?>"><?= $error_message ?></p>
    <h2>Les 5 catégories affichées sur la home page</h2>
    <form id="orderForm" action="" method="POST" class="mt-5">
        <?= csrf_field() ?>
        <div class="row">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="col">
                    <div class="form-group">
                        <label for="emplacement<?= $i ?>">Emplacement #<?= $i ?></label>
                        <select class="form-control" id="emplacement<?= $i ?>" name="emplacement[<?= $i ?>]">
                            <?php foreach( $categories as $category ): ?>
                                <option value="<?= $category->id ?>" <?= $category->home_order == $i ? 'selected' : '' ?>><?= $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php endfor;?>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        <p class="bg-success mt-2 text-white <?= isset($success_message) ?  'p-2' : '' ?>"><?= $success_message ?></p>
    </form>
</div>
