<div class="container my-4">
    <form id="orderForm" action="" method="POST" class="mt-5">
        <input type="hidden" name="token" value="">
        <div class="row">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="col">
                    <div class="form-group">
                        <label for="emplacement<?= $i ?>">Emplacement #<?= $i ?></label>
                        <select class="form-control" id="emplacement<?= $i ?>" name="emplacement[<?= $i ?>]">
                            <option value="">choisissez :</option>
                            <?php foreach( $categories as $category ): ?>
                                <option value="<?= $category->id ?>" selected><?= $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php endfor;?>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>
