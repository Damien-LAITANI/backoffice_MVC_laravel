<div class="container my-4">
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
                    <td><?= $product->description ?></td>
                    <td><?= $product->price ?></td>
                    <td class="text-end">
                        <a href="<?= route('product-edit', ['id' => $product->id]) ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <a  href=""  class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>

                        </div>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>
