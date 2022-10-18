<div class="container my-4">
    <p class="bg-<?= isset($success_message)  ?  'success p-2 text-white' : '', isset($error_message) ? 'danger p-2 text-white' : '' ?>"><?= $success_message ?? $error_message ?></p>
    <a href="<?= route('product-add') ?>" class="btn btn-success float-end">Ajouter</a>
    <h2>Liste des produits</h2>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Description</th>
                <th scope="col">Prix</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($products as $product) : ?>
                <tr>
                    <th scope="row"><?= $product->id ?></th>
                    <td><?= $product->name ?></td>
                    <td class="w-75"><?= $product->description ?></td>
                    <td><?= $product->price ?></td>
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
            <?php endforeach ?>

        </tbody>
    </table>
</div>
