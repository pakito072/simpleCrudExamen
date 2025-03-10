<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Crud Simple</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- STYLES -->
  <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css') ?>">
</head>

<body class="bg-dark">
  <header class="container rounded-3" style="background-color:#f4f02c;">
    <div class="d-flex justify-content-between align-items-center m-4">
      <h1>Lista de Usuarios</h1>
      <form class="d-flex" method="get" action="<?= base_url('/') ?>">
        <input class="form-control me-2" type="search" name="search" placeholder="Buscar" value="<?= $search ?>">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown"
          aria-expanded="false">
          Filtros
        </button>
        <div class="dropdown-menu p-4">
          <form method="get" action="<?= base_url('/') ?>">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>">
            </div>
            <div class="mb-3">
              <label for="created_at" class="form-label">Created At</label>
              <input type="date" class="form-control" id="created_at" name="created_at" value="<?= $created_at ?>">
            </div>
            <div class="mb-3">
              <label for="updated_at" class="form-label">Updated At</label>
              <input type="date" class="form-control" id="updated_at" name="updated_at" value="<?= $updated_at ?>">
            </div>
            <div class="mb-3">
              <label for="is_disabled" class="form-label">Is Disabled</label>
              <select class="form-control" id="is_disabled" name="is_disabled">
                <option value="">Select</option>
                <option value="1" <?= $is_disabled === '1' ? 'selected' : '' ?>>Yes</option>
                <option value="0" <?= $is_disabled === '0' ? 'selected' : '' ?>>No</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
          </form>
        </div>
      </div>
      <a href="<?= base_url('home/export?search=' . $search . '&username=' . $username . '&email=' . $email . '&created_at=' . $created_at . '&updated_at=' . $updated_at . '&is_disabled=' . $is_disabled . '&sort=' . $sort . '&order=' . $order) ?>"
        class="btn btn-success btn-lg">Exportar</a>
      <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#createModal">Crear Usuario</button>
    </div>
  </header>

  <!-- Mensajes de confirmación -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>

  <!-- CONTENT -->
  <main>
    <div class="container">
      <table class="table table-striped">
        <thead>
          <tr>
            <th><a
                href="<?= base_url('/?sort=id&order=' . ($sort == 'id' && $order == 'asc' ? 'desc' : 'asc') . '&search=' . $search . '&username=' . $username . '&email=' . $email . '&created_at=' . $created_at . '&updated_at=' . $updated_at . '&is_disabled=' . $is_disabled) ?>">ID
                <?= $sort == 'id' ? ($order == 'asc' ? '↑' : '↓') : '' ?></a></th>
            <th><a
                href="<?= base_url('/?sort=username&order=' . ($sort == 'username' && $order == 'asc' ? 'desc' : 'asc') . '&search=' . $search . '&username=' . $username . '&email=' . $email . '&created_at=' . $created_at . '&updated_at=' . $updated_at . '&is_disabled=' . $is_disabled) ?>">Username
                <?= $sort == 'username' ? ($order == 'asc' ? '↑' : '↓') : '' ?></a></th>
            <th><a
                href="<?= base_url('/?sort=email&order=' . ($sort == 'email' && $order == 'asc' ? 'desc' : 'asc') . '&search=' . $search . '&username=' . $username . '&email=' . $email . '&created_at=' . $created_at . '&updated_at=' . $updated_at . '&is_disabled=' . $is_disabled) ?>">Email
                <?= $sort == 'email' ? ($order == 'asc' ? '↑' : '↓') : '' ?></a></th>
            <th><a
                href="<?= base_url('/?sort=created_at&order=' . ($sort == 'created_at' && $order == 'asc' ? 'desc' : 'asc') . '&search=' . $search . '&username=' . $username . '&email=' . $email . '&created_at=' . $created_at . '&updated_at=' . $updated_at . '&is_disabled=' . $is_disabled) ?>">Created
                At <?= $sort == 'created_at' ? ($order == 'asc' ? '↑' : '↓') : '' ?></a></th>
            <th><a
                href="<?= base_url('/?sort=updated_at&order=' . ($sort == 'updated_at' && $order == 'asc' ? 'desc' : 'asc') . '&search=' . $search . '&username=' . $username . '&email=' . $email . '&created_at=' . $created_at . '&updated_at=' . $updated_at . '&is_disabled=' . $is_disabled) ?>">Updated
                At <?= $sort == 'updated_at' ? ($order == 'asc' ? '↑' : '↓') : '' ?></a></th>
            <th><a
                href="<?= base_url('/?sort=is_disabled&order=' . ($sort == 'is_disabled' && $order == 'asc' ? 'desc' : 'asc') . '&search=' . $search . '&username=' . $username . '&email=' . $email . '&created_at=' . $created_at . '&updated_at=' . $updated_at . '&is_disabled=' . $is_disabled) ?>">Is
                Disabled <?= $sort == 'is_disabled' ? ($order == 'asc' ? '↑' : '↓') : '' ?></a></th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($users)): ?>
            <tr>
              <td colspan="7" class="text-center">No se han encontrado registros</td>
            </tr>
          <?php else: ?>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <td><?= $user['updated_at'] ?></td>
                <td><?= $user['is_disabled'] ? 'Yes' : 'No' ?></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      Acciones
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="<?= base_url('home/edit/' . $user['id']) ?>" data-bs-toggle="modal"
                          data-bs-target="#editModal">Editar</a></li>
                      <?php if ($user['is_disabled']): ?>
                        <li>
                          <form action="<?= base_url('home/restore/' . $user['id']) ?>" method="post" style="display:inline;">
                            <button type="submit" class="dropdown-item">Restaurar</button>
                          </form>
                        </li>
                      <?php else: ?>
                        <li>
                          <form action="<?= base_url('home/disable/' . $user['id']) ?>" method="post" style="display:inline;">
                            <button type="submit" class="dropdown-item">Deshabilitar</button>
                          </form>
                        </li>
                      <?php endif; ?>
                    </ul>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        <?= $pager->links('default', 'my_pagination') ?>
      </div>
    </div>
  </main>

  <!-- FOOTER: DEBUG INFO + COPYRIGHTS -->
  <footer class="container text-center text-white mt-5">
    <h3>CodeIgniter 4 CRUD Simple</h3>
  </footer>

  <!-- MODALS -->
  <!-- Create Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Crear Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('home/create') ?>" method="post">
          <div class="modal-body">
            <?php if (session()->getFlashdata('errors')): ?>
              <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                  <p><?= $error ?></p>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>"
                id="username" name="username" value="<?= old('username') ?>" required>
              <?php if (session('errors.username')): ?>
                <div class="invalid-feedback">
                  <?= session('errors.username') ?>
                </div>
              <?php endif; ?>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" id="email"
                name="email" value="<?= old('email') ?>" required>
              <?php if (session('errors.email')): ?>
                <div class="invalid-feedback">
                  <?= session('errors.email') ?>
                </div>
              <?php endif; ?>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                id="password" name="password" required>
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
    </div>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <?php if (isset($user)): ?>
        <?= view('edit_modal', ['user' => $user]) ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- SCRIPTS -->
  <script src="<?= base_url('/assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>