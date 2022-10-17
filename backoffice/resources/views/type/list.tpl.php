<div class="container my-4">
    <a href="<?= route('type-add') ?>" class="btn btn-success float-end">Ajouter</a>
    <h2>Liste des types</h2>
    <p class="bg-success <?= isset($success_message) ?  'p-2 text-white' : '' ?>"><?= $success_message ?></p>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($types as $type): ?>
            <tr>
                <th scope="row"><?= $type->id ?></th>
                <td><?= $type->name ?></td>
                <td class="text-end">
                    <a href="<?= route('type-edit', ['id' => $type->id]) ?>" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <!-- Example single danger button -->
                    <a href="<?= route('type-delete', ['id' => $type->id]) ?>" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
