<div class="container my-4">
    <h2>Se connnecter au BackOffice</h2>

    <form class=" g-3 needs-validation mt-5" action="<?= route('auth-connection') ?>" method="post">
        <?= csrf_field() ?>
        <?php if (isset($errorList)) : ?>
            <div class="alert alert-warning" role="alert">
                <?= $errorList[0] ?>
            </div>
        <?php endif ?>
        <div class="mb-4">
            <label for="validationCustom01" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" id="validationEmail" value="<?= old('email') ?? 'lucie@oclock.io' ?>" placeholder="test@test.test" required>
        </div>

        <div class="mb-4">
            <label for="validationCustom02" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="validationPassword" value="cameleon" required>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Se connecter</button>
            <p class="bg-danger <?= isset($error_email) ?  'p-3 text-white' : '' ?>"><?= $error_email ?></p>
        </div>
    </form>
</div>
