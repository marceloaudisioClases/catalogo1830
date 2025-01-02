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
    <br>
    
    <div class="container">
    <div class="container text-center">
      <h1>
        <a href="<?= site_url('usuarios/fotoperfil'); ?>" title="Shh...." style="color: black; text-decoration: none;">
          <i class="bi bi-pencil-square"></i> Modificar Datos
        </a>
      </h1>
      <p style="margin-left: 20px;">Sincronización de Datos en Tiempo Real</p>
      
      <?php
         if (isset($usuario['imagen_perfil'])) {
                  $selected_image = $usuario['imagen_perfil'];
          } else {
                  $selected_image = 'fondo0.png';
          }
           echo "<img src='" . base_url('img_user/' . $selected_image) . "' alt='Imagen de perfil' class='rounded-circle mb-3 img-fluid' style='width: 150px; height: 150px;'>";
      ?>
      
      <table class="table my-4">
        <tr>
          <th class="text-center" colspan="2" id="gsts">¡COMPLETA EL FORMULARIO PARA ACTUALIZARLO!</th>
        </tr>
      </table>

      <div class="card">
        <div class="card-body">
          <?php if ($this->session->flashdata('MSJ')) { ?>
            <div class="alert alert-success"><strong>¡Éxito!</strong> <?= $this->session->flashdata('MSJ'); ?></div>
          <?php } ?>
          <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger"><strong>Error:</strong> <?= $this->session->flashdata('error'); ?></div>
          <?php } ?>

          <form method="POST" action="<?= site_url('usuarios/actualizar'); ?>" id="frm_actualizar">
            <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id']; ?>">

        <div class="row mb-3">
        <div class="col-12 col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control entrada 
            <?php 
            if (isset($email_error)) { 
                echo 'is-invalid'; 
            } 
            ?>" id="email" name="email" value="<?= $usuario['email']; ?>" required>
        <div class="invalid-feedback">
            <?php 
            if (isset($email_error)) { 
                echo $email_error; 
            } else { 
                echo 'Este campo es obligatorio.'; 
            } 
            ?>
              </div>
            </div>
          <div class="col-12 col-md-6">
            <label for="conf_email" class="form-label">Confirmar Email</label>
            <input type="email" class="form-control entrada 
            <?php 
            if (isset($conf_email_error)) { 
                echo 'is-invalid'; 
            } 
            ?>" id="conf_email" name="conf_email" value="<?= $usuario['email']; ?>" required>
          <div class="invalid-feedback">
            <?php 
            if (isset($conf_email_error)) { 
                echo $conf_email_error; 
            } else { 
                echo 'Los correos no coinciden.'; 
            } 
            ?>
              </div>
             </div>
            </div>


          <div class="row mb-3">
            <div class="col-12 col-md-6">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" 
               class="form-control entrada <?php if (isset($apellido_error)) { echo 'is-invalid'; } ?>" 
               id="apellido" 
               name="apellido" 
               value="<?php echo $usuario['apellido']; ?>" 
               required>
            <div class="invalid-feedback">
            <?php 
                if (isset($apellido_error)) { 
                    echo $apellido_error; 
                } else { 
                    echo 'Este campo es obligatorio.'; 
                } 
                ?>
              </div>
             </div>
            <div class="col-12 col-md-6">
                <label for="conf_apellido" class="form-label">Confirmar Apellido</label>
                <input type="text" 
                class="form-control entrada <?php if (isset($conf_apellido_error)) { echo 'is-invalid'; } ?>" 
                id="conf_apellido" 
                name="conf_apellido" 
                value="<?php echo $usuario['apellido']; ?>" 
                required>
            <div class="invalid-feedback">
              <?php 
                if (isset($conf_apellido_error)) { 
                    echo $conf_apellido_error; 
                } else { 
                    echo 'Los apellidos no coinciden.'; 
                } 
              ?>
                </div>
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-12 col-md-6">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" 
               class="form-control entrada <?php if (isset($nombre_error)) { echo 'is-invalid'; } ?>" 
               id="nombre" 
               name="nombre" 
               value="<?php echo $usuario['nombre']; ?>" 
               required>
            <div class="invalid-feedback">
               <?php 
                if (isset($nombre_error)) { 
                    echo $nombre_error; 
                } else { 
                    echo 'Este campo es obligatorio.'; 
                } 
               ?>
                </div>
              </div>
            <div class="col-12 col-md-6">
              <label for="conf_nombre" class="form-label">Confirmar Nombre</label>
              <input type="text" 
               class="form-control entrada <?php if (isset($conf_nombre_error)) { echo 'is-invalid'; } ?>" 
               id="conf_nombre" 
               name="conf_nombre" 
               value="<?php echo $usuario['nombre']; ?>" 
               required>
            <div class="invalid-feedback">
              <?php 
                if (isset($conf_nombre_error)) { 
                    echo $conf_nombre_error; 
                } else { 
                    echo 'Los nombres no coinciden.'; 
                } 
              ?>
                  </div>
                </div>
              </div>  


            <div class="row mb-3">
              <div class="col-12 col-md-6">
              <label for="usuario" class="form-label">Usuario</label>
                <input type="text" 
                 class="form-control entrada <?php if (isset($usuario_error)) { echo 'is-invalid'; } ?>" 
                 id="usuario" 
                 name="usuario" 
                 value="<?php echo $usuario['usuario']; ?>"required> 
            <div class="invalid-feedback">
              <?php 
                if (isset($usuario_error)) { 
                    echo $usuario_error; 
                } else { 
                    echo 'Este campo es obligatorio.'; 
                } 
              ?>
                </div>
              </div>
            <div class="col-12 col-md-6">
              <label for="conf_usuario" class="form-label">Confirmar Usuario</label>
              <input type="text" 
              class="form-control entrada <?php if (isset($conf_usuario_error)) { echo 'is-invalid'; } ?>" 
              id="conf_usuario" 
              name="conf_usuario" 
              value="<?php echo $usuario['usuario']; ?>" required> 
            <div class="invalid-feedback">
              <?php 
                if (isset($conf_usuario_error)) { 
                    echo $conf_usuario_error; 
                } else { 
                    echo 'Los usuarios no coinciden.'; 
                } 
              ?>
                </div>
               </div>
              </div>


            <div class="text-center">
              <a href="<?= site_url('usuarios'); ?>" class="btn btn-primary" title="Volver a Usuarios">Volver</a>
              <button type="submit" class="btn btn-success">Confirmar cambios <i class="bi bi-check-circle-fill"></i></button>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
