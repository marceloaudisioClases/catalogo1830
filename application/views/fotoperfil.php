<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      body {
        background-color: black;
      }
      #colormodalp {
        background-color: #121212;
        color: white;
      }
    </style>
  </head>
  <body>
    <div class="container-xxl my-5">
      <div class="card mx-auto" id="colormodalp" style="max-width: 48rem;">
        <div class="card-header text-center d-flex align-items-center justify-content-between">
          <a href="<?php echo site_url('usuarios'); ?>" class="btn btn-dark me-2" title="Volver al formulario">
            <i class="bi bi-x-lg"></i>
          </a>
          <h5 class="mb-0 flex-grow-1 text-center">Cambiar imagen de perfil</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 text-center">
              <p>Imagen de perfil</p>
              <p class="card-text">
                Si añades una foto, otras personas podrán reconocerte y sabrás si has iniciado sesión en tu cuenta.
              </p>
              <hr>
          
              <?php
                $selected_image = isset($usuario['imagen_perfil']) ? $usuario['imagen_perfil'] : 'fondo0.png';
                echo "<img src='" . base_url('img_user/' . $selected_image) . "' alt='Imagen de perfil' class='rounded-circle mb-3 img-fluid' style='width: 300px; height: 300px;'>";
              ?>
            </div>

            <div class="col-md-6 text-center">
              <p>Ilustraciones <i class="bi bi-palette"></i></p> 
              <form method="POST" action="">
                <div class="row row-gap-5 justify-content-end">
                  <div class="col-sm-4">
                    <button type="submit" name="profile_pic" value="fondo1.png" class="btn btn-link p-0">
                      <img src="<?php echo base_url('img_user/fondo1.png'); ?>" class="img-fluid rounded-circle" title="Seleccionar Foto">
                    </button>
                  </div>
                  <div class="col-sm-4">
                    <button type="submit" name="profile_pic" value="fondo2.png" class="btn btn-link p-0">
                      <img src="<?php echo base_url('img_user/fondo2.png'); ?>" class="img-fluid rounded-circle" title="Seleccionar Foto">
                    </button>
                  </div>
                  <div class="col-sm-4">
                    <button type="submit" name="profile_pic" value="fondo3.png" class="btn btn-link p-0">
                      <img src="<?php echo base_url('img_user/fondo3.png'); ?>" class="img-fluid rounded-circle" title="Seleccionar Foto">
                    </button>
                  </div>
                </div>
                <br>
                <div class="row row-gap-5 justify-content-end">
                  <div class="col-sm-4">
                    <button type="submit" name="profile_pic" value="fondo4.png" class="btn btn-link p-0">
                      <img src="<?php echo base_url('img_user/fondo4.png'); ?>" class="img-fluid rounded-circle" title="Seleccionar Foto">
                    </button>
                  </div>
                  <div class="col-sm-4">
                    <button type="submit" name="profile_pic" value="fondo5.png" class="btn btn-link p-0">
                      <img src="<?php echo base_url('img_user/fondo5.png'); ?>" class="img-fluid rounded-circle" title="Seleccionar Foto">
                    </button>
                  </div>
                  <div class="col-sm-4">
                    <button type="submit" name="profile_pic" value="fondo7.png" class="btn btn-link p-0">
                      <img src="<?php echo base_url('img_user/fondo7.png'); ?>" class="img-fluid rounded-circle" title="Seleccionar Foto">
                    </button>
                  </div>
                </div>
              </form>

              <?php
                if (isset($selected_image)) {
                  echo "<div class='alert alert-success mt-4 text-center' role='alert'>
                          Foto actualizada: $selected_image
                        </div>";
                }
              ?>

              <form method="POST" action="">
                <button type="submit" name="profile_pic" value="fondo0.png" class="btn btn-secondary mt-3">
                  <i class="bi bi-trash3"></i> Retirar imagen
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>