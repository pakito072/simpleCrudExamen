<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="<?= base_url('home/update/' . $user['id']) ?>" method="post">
        <div class="modal-body">
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="edit-username" class="form-label">Username</label>
                <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>"
                    id="edit-username" name="username" value="<?= old('username', $user['username']) ?>" required>
                <?php if (session('errors.username')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.username') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="edit-email" class="form-label">Email</label>
                <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                    id="edit-email" name="email" value="<?= old('email', $user['email']) ?>" required>
                <?php if (session('errors.email')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.email') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="edit-password" class="form-label">Password</label>
                <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                    id="edit-password" name="password">
                <?php if (session('errors.password')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>