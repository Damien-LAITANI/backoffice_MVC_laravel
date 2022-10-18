<section class="container my-4">
    <p class="bg-danger <?= isset($error_message) ?  'p-2 text-white' : '' ?>"><?= $error_message ?></p>
    <h2>Les 5 catégories affichées sur la home page</h2>
    <form id="orderForm" action="" method="POST" class="mt-5">
        <?= csrf_field() ?>
        <div class="row">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="col">
                    <div class="form-group">
                        <label for="location<?= $i ?>">Emplacement #<?= $i ?></label>
                        <select class="form-control selected__order" id="location<?= $i ?>" name="location[<?= $i ?>]">
                            <?php foreach( $categories as $category ): ?>
                                <option value="<?= $category->id ?>" <?= $category->home_order == $i ? 'selected' : '' ?>><?= $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php endfor;?>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
                <p class="bg-success mt-2 text-white <?= isset($success_message) ?  'p-2' : '' ?>"><?= $success_message ?></p>
            </div>
    </form>
</section>
<section>
    <div class="container-fluid w-75 my-2 border py-2">
        <h3>Visuel de la page d'accueil :</h3>
        <div class="row">
            <?php for ($i = 0; $i <= 1; $i++): ?>
                <div class="col-md-6">
                    <div class="card border-0 text-white text-center"><img src="<?= $categoriesOrderByHomePage[$i]->picture ?>" alt="Card image" class="card-img" width="200px">
                        <div class="card-img-overlay d-flex align-items-center">
                            <div class="w-100 py-3">
                                <h2 class="display-3 font-weight-bold mb-4 categoryTitle"><?= $categoriesOrderByHomePage[$i]->name ?></h2><a href="#" class="btn btn-light">C'est parti</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="row my-2 mx-0">

            <?php for ($i = 2; $i <= 4; $i++): ?>
            <div class="col-lg-4 ">
                <div class="card border-0 text-center text-white"><img src="<?= $categoriesOrderByHomePage[$i]->picture ?>" alt="Card image" class="card-img" width="150px">
                    <div class="card-img-overlay d-flex align-items-center">
                        <div class="w-100">
                            <h2 class="display-4 mb-4 categoryTitle"><?= $categoriesOrderByHomePage[$i]->name ?></h2><a href="#" class="btn btn-link text-dark bg-light">Faire un tour
                                <i class="fa-arrow-right fa ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
