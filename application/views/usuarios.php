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
    <?php 
    $this->load->view("menu");
    ?>
  <br>
    <div class="container">

    <div class="container text-center">
      <h1><i class="bi bi-person-bounding-box"></i> Administración de Usuarios</h1>
      <p style="margin-left: 20px;">Visualización y Modificación Dinámica de Datos</p>
      
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" colspan="2" id="gsts"> 
                <a href="<?php echo site_url('usuarios/exportar_csv_usuarios'); ?>">
                  <i class="bi bi-file-earmark-arrow-down" style="color: white;" title="Exportar CSV"></i>
                </a>
                FILTRO DE BÚSQUEDA
                <i class="bi bi-info-circle" data-bs-toggle="modal" data-bs-target="#infoModal" title="¿Qué hace cada Filtro?" style="cursor: pointer;"></i>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td class="text-center" colspan="2">
              <form class="d-flex" action="<?php echo site_url('usuarios/buscar'); ?>" method="GET">
                <div class="row w-100">
                  <div class="col-md-6 d-flex">
                    <div class="ms-2 flex-fill">
                      <input class="form-control" type="search" placeholder="Buscar por Rol: 1 Admin, 2 Usuario, 3 Cliente." name="rol" id="rolBusqueda" style="width: 100%;"/>
                    </div>
                    <button class="btn btn-outline-primary ms-2" type="submit"> Buscar</button>
                  </div>


                  <div class="col-md-6 d-flex">
                    <div class="ms-2 flex-fill">
                      <input class="form-control" type="search" placeholder="Buscar por Nombre" name="nombre" id="nombreBusqueda" style="width: 100%;"/></div>
                      <button class="btn btn-outline-primary ms-2" type="submit"> Buscar</button>
                    </div>
                  </div>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    
      <?php 
        if ((!isset($_GET['rol']) or $_GET['rol'] === '') and (!isset($_GET['nombre']) or $_GET['nombre'] === '')) { ?> 
        <div class="alert alert-info text-center">
        Usa las barras de búsquedas para filtrar los resultados de los usuarios.
        </div>  
      <?php } ?>



      <?php if (isset($_GET['rol']) or isset($_GET['nombre'])) { ?> 
        <div class="card">
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
              <thead>
                <tr>
                  <th class="text-center" colspan="2" id="gsts">RESULTADOS DE BUSQUEDA</th>
                </tr>
              </thead>
            </table>
          </div>
          <br>

          <?php if (isset($usuarios) and $usuarios) { ?> 
            <?php foreach ($usuarios as $usuario) { ?>
              <div class="card mb-3">
                <div class="card-body pt-0">
                  <h3 class="mb-3">Información Actual</h3>
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                      <thead>
                        <tr>
                          <th>Icono</th>
                          <th>Usuario ID</th>
                          <th>Rol</th>
                          <th>Email</th>
                          <th>Apellido</th>
                          <th>Nombre</th>
                          <th>Usuario</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <td> <?php if (isset($usuario['imagen_perfil']) and strlen($usuario['imagen_perfil']) > 0) { ?> 
                            <img src="<?php echo base_url('img_user/' . $usuario['imagen_perfil']); ?>" 
                             alt="Imagen de <?php echo $usuario['nombre']; ?>" 
                             class="rounded-circle img-fluid" 
                             style="width: 50px; height: 50px;">
                            <?php } ?></td>
                          
                          <td><?php if (isset($usuario['usuario_id'])) { echo $usuario['usuario_id']; } else { echo ''; } ?></td>
                          <td><?php if (isset($usuario['rol_id'])) { echo $usuario['rol_id']; } else { echo ''; } ?></td>
                          <td><?php if (isset($usuario['email'])) { echo $usuario['email']; } else { echo ''; } ?></td>
                          <td><?php if (isset($usuario['apellido'])) { echo $usuario['apellido']; } else { echo ''; } ?></td>
                          <td><?php if (isset($usuario['nombre'])) { echo $usuario['nombre']; } else { echo ''; } ?></td>
                          <td><?php if (isset($usuario['usuario'])) { echo $usuario['usuario']; } else { echo ''; } ?></td>

                          <td>
                            <a href="<?= site_url('usuarios/editar/' . $usuario['usuario_id']); ?>" class="btn btn-primary" title="Editar datos">
                              <i class="bi bi-pencil-square"></i> Modificar Datos
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <?php } ?>
          <?php }else{ ?>
            <div class="alert alert-danger text-center">No encontré información sobre usuarios.</div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div> 

      <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="infoModalLabel">Información sobre los filtros</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <p><strong>Búsqueda por Nombre:</strong> Este campo te permite buscar usuarios por su nombre. Los resultados incluirán cualquier usuario, sin importar su rol.</p>
          <hr>
          <p><strong>Búsqueda por Rol:</strong> Este campo filtra los usuarios por su rol específico (1 Administrador, 2 Usuario o 3 Cliente).</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">¡Entendido!</button>
        </div>
      </div>
    </div>
  </div>
    <br>

    <div class="text-center">
      <video style="width: 100%; max-width: 1300px; height: auto;" autoplay muted loop>
        <source src="<?php echo base_url('img_user/videohilet.mp4'); ?>" type="video/mp4">
      </video>
    </div>



      <!--PARTE 2 -->
    <div class="container my-4">
      <div class="table-responsive mb-4">
        <div class="card mb-0">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th class="text-center" colspan="2" id="gsts">
                  ELIMINACIÓN LÓGICA
                  <i class="bi bi-info-circle" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalborrado" title="¿Cómo funciona el borrado lógico?"></i>
                </th>
              </tr>
            </thead>
          </table>
        </div>
      </div>

      <div class="mb-4">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
            <th class="text-center" style="width: 50%;">
            <form action="<?= site_url('usuarios/buscar'); ?>#apellidoBusqueda" method="GET">
              <div class="mb-2">
                <input class="form-control" type="search" placeholder="Buscar por Apellido" name="apellido" id="apellidoBusqueda" style="width: 100%;" required>
              </div>

              <div class="d-flex justify-content-between align-items-center gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">Buscar</button>              
              </div>
            </form>
          </th>
              <th>
              <?php if ($this->session->flashdata('MSJ')) { ?>
               <div class="alert alert-success">
                <?= $this->session->flashdata('MSJ') ?>
                  </div>
                    <?php } else { 
                    if ($this->session->flashdata('error')) { ?>
                   <div class="alert alert-danger">
                    <?= $this->session->flashdata('error') ?>
                       </div>
                        <?php } ?>
                         <?php } ?>

               <div class="d-grid gap-2">
                  <a href="<?= site_url('usuarios/ir_papelera'); ?>" class="btn btn-primary">
                    <i class="bi bi-recycle"></i> Ver Papelera de Reciclaje
                  </a>
                </div>
              </th>
            </tr>
          </thead>
        </table>
      </div>

        <?php 
            if ((!isset($_GET['apellido']) or $_GET['apellido'] === '') and (!isset($_GET['nombre']) or $_GET['nombre'] === '')) { ?> 
            <div class="alert alert-info text-center">
                Usa la barra de búsqueda para filtrar usuarios.
            </div>
        <?php } ?>



        <?php if (isset($_GET['apellido']) and $_GET['apellido'] !== '') { ?>
          <?php if (isset($usuarios) and count($usuarios) > 0) { ?>
            <?php foreach ($usuarios as $usuario) { ?>
            <div class="card mb-3">
              <div class="card-body">
                <h3 class="mb-3 text-center">Información Solicitada</h3>
                <div class="table-responsive">
                  <table class="table table-bordered table-hover mb-0">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Último Login</th>
                        <th>Mot. Eliminación</th>
                        <th>Estado</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>                       
                        <td><?= $usuario['usuario_id'] ?></td>
                      <td><?= $usuario['apellido'] ?></td>
                      <td><?= $usuario['nombre'] ?></td>
                      <td><?= $usuario['email'] ?></td>
                      <td>
                        <?php 
                        if (isset($usuario['ult_login']) and $usuario['ult_login'] !== '') {
                        echo $usuario['ult_login'];
                        } else {
                        echo 'Nunca';
                        }
                        ?>
                        </td>
                      <td>
                     <?php 
                      if (isset($usuario['motivo_eliminacion']) and $usuario['motivo_eliminacion'] !== '') { 
                          echo $usuario['motivo_eliminacion']; 
                      } else { 
                          echo '&nbsp;'; 
                      } 
                      ?>
                        </td>
                      <td>
                    <?php 
                      if ($usuario['estado'] == 1) {
                        echo 'Activo';
                      } else {
                        echo 'Inactivo';
                      }
                    ?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarmodalconf-<?= $usuario['usuario_id'] ?>">
                            <i class="bi bi-trash-fill"></i> Eliminar
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php }else{ ?>
          <div class="alert alert-danger text-center">No se encontraron usuarios para el apellido seleccionado.</div>
        <?php } ?>
      <?php } ?>

      <div class="modal fade" id="modalborrado" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="infoModalLabel">¿Cómo funciona?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
           <strong>BORRADO LOGICO</strong> Asegura que los registros no se eliminen de forma fisica, sino que se marquen como inactivos (-1).
            <hr>
            Tiene la capacidad de restauración sin comprometer la integridad de la base de datos de forma responsable, preservando así su integridad.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">¡Entendido!</button>
            </div>
          </div>
        </div>
      </div>



     

      <?php foreach ($usuarios as $usuario) { ?>
        <div class="modal fade" id="eliminarmodalconf-<?= $usuario['usuario_id'] ?>" tabindex="-1" aria-labelledby="eliminarmodalLabel-<?= $usuario['usuario_id'] ?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="eliminarmodalLabel-<?= $usuario['usuario_id'] ?>">Motivo de eliminación:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                <form action="<?= site_url('usuarios/eliminar') ?>" method="POST">
                  <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
                  <div class="mb-3">
                    <textarea class="form-control" name="motivo" rows="3" placeholder="Escribe aquí el motivo..." required></textarea>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </div>
                </form>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <br>
    
    <div class="text-center">
      <img src="<?php echo base_url('img_user/fondonull.png'); ?>" class="img-fluid" alt="HILET" style="width: 100%; max-width: 1300px; height: auto;">
    </div>
    <br>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
