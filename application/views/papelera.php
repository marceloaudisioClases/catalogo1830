<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuarios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {
      background-color: #e9ecef;
    }
    #gsts {
      color: white;
      background-color: #007bff;
      font-size: 30px;
    }
  </style>
</head>
<body>
  <?php $this->load->view("menu"); ?>

  <div class="container my-4">
    <div class="table-responsive mb-4">
      <div class="card mb-0">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
            <th class="text-center" colspan="2" id="gsts">
            <a href="<?= site_url('usuarios') ?>" class="btn btn-outline-primary ms-3" title="Volver a Usuarios">
              <i class="bi bi-box-arrow-in-left"></i>
            </a>
              PAPELERA DE CONSULTAS
            </th>

            </tr>
          </thead>
        </table>
      </div>
    </div>

    <?php foreach ($eliminados as $usuario){ ?>
  <div class="card mb-3">
    <div class="card-body">
      <h3 class="mb-3 text-center">Información Eliminada</h3>
      <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Rol</th>
              <th>Email</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Estado</th>
              <th>Mot. Eliminación</th>
              <th>Fecha de Eliminación</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?= $usuario['usuario_id'] ?></td>
              <?php
              $roles = [
                1 => 'Administrador',
                2 => 'Usuario',
                3 => 'Cliente',
              ];
              ?>
             <td>
                <?php 
                if (isset($roles[$usuario['rol_id']])) { 
                    echo $roles[$usuario['rol_id']]; 
                } else { 
                    echo 'Desconocido'; 
                } 
                ?>
            </td>
              <td><?= $usuario['email'] ?></td>
              <td><?= $usuario['nombre'] ?></td>
              <td><?= $usuario['apellido'] ?></td>
              <td><?= $usuario['estado'] ?></td>
              <td><?= $usuario['motivo_eliminacion'] ?></td>
              <td><?= $usuario['fecha_eliminacion'] ?></td>
              <td>
                <form action="<?= site_url('usuarios/restaurar') ?>" method="POST" style="display: inline;">
                  <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
                  <button type="submit" class="btn btn-success btn-sm">
                    <i class="bi bi-arrow-counterclockwise"></i> Restaurar
                  </button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php } ?>

<?php if ($this->session->flashdata('MSJ')) { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('MSJ') ?>
  </div>
<?php } ?>
<?php if ($this->session->flashdata('error')) { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= $this->session->flashdata('error') ?>
  </div>
<?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
