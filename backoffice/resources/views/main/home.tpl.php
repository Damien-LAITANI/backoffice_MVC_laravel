<?php
    // d($products[0]->tag);
?>

<div class="container my-4">
        <p class="display-4">
            Bienvenue dans le backOffice de <strong>Bedacier</strong>...
        </p>
        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <div class="card text-white mb-3">
                    <div class="card-header bg-primary">Liste des catégories</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($categories)) {
                                    foreach($categories as $category): ?>
                                    <tr>
                                        <th scope="row"><?= $category->id ?></th>
                                        <td><?= $category->name ?></td>
                                        <td class="text-end">
                                            <a href="<?= route('category-edit', ['id' => $category->id]) ?>" class="btn btn-sm btn-warning">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <div class="btn-group">
                                                <a href="<?= route('category-delete', ['id' => $category->id]) ?>" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;
                                } ?>

                            </tbody>
                        </table>
                        <div class="d-grid gap-2">
                            <a href="<?= route('category-list') ?>" class="btn btn-success">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card text-white mb-3">
                    <div class="card-header bg-primary">Liste des produits</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($products)) {
                                    foreach($products as $product): ?>
                                <tr>
                                    <th scope="row"><?= $product->id ?></th>
                                    <td><?= $product->name ?></td>
                                    <td class="text-end">
                                        <a href="<?= route('product-edit', ['id' => $product->id]) ?>" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <div class="btn-group">
                                            <a href="<?= route('product-delete', ['id' => $product->id]) ?>" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;
                                } ?>

                            </tbody>
                        </table>
                        <div class="d-grid gap-2">
                            <a href="<?= route('product-list') ?>" class="btn btn-success">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
