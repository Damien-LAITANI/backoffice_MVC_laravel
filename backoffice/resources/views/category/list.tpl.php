<div class="container my-4">
    <p class="bg-<?= isset($success_message)  ?  'success p-2 text-white' : '', isset($error_message) ? 'danger p-2 text-white' : '' ?>"><?= $success_message ?? $error_message ?></p>
    <a href="<?= route('category-add') ?>" class="btn btn-success float-end">Ajouter</a>
    <h2>Liste des catégories</h2>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Sous-titre</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $category): ?>
            <tr>
                <th scope="row"><?= $category->id ?></th>
                <td><?= $category->name ?></td>
                <td><?= $category->subtitle ?></td>
                <td class="text-end">
                    <a href="<?= route('category-edit', ['id' => $category->id]) ?>" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a href="<?= route('category-delete', ['id' => $category->id]) ?>" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
