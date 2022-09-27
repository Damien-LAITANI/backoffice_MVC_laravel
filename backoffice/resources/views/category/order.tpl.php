<div class="container my-4">
    <h2>Les 5 catégories affichées sur la home page</h2>
    <p class="bg-info <?= isset($error_message) ?  'p-3' : '' ?>"><?= $error_message ?></p>
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
        <p class="bg-success mt-2 text-white <?= isset($success_message) ?  'p-3' : '' ?>"><?= $success_message ?></p>
    </form>
</div>
