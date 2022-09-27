<div class="container my-4">
    <a href="<?= route('brand-add') ?>" class="btn btn-success float-end">Ajouter</a>
    <h2>Liste des marques</h2>
    <p class="bg-info <?= isset($delete_message) ?  'p-3' : '' ?>"><?= $delete_message ?></p>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($brands as $brand): ?>
            <tr>
                <th scope="row"><?= $brand->id ?></th>
                <td><?= $brand->name ?></td>
                <td class="text-end">
                    <a href="<?= route('brand-edit', ['id' => $brand->id]) ?>" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <!-- Example single danger button -->
                    <a href="<?= route('brand-delete', ['id' => $brand->id]) ?>" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
