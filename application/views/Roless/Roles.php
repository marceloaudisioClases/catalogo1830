<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Roles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:ital,wght@0,100..700;1,100..700&family=Jost:ital,wght@0,100..900;1,100..900&family=Mate:ital@0;1&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Tinos:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet"> <!--Modal-->
  <style>
    body {
      background-color: #e9ecef;
    }
    #gsts {
      color: white;
      background-color: #007bff;
      font-size: 30px;
    }
    #colormodal {
      color: #2a2a2e;
      font-family:"Tinos", serif;
      font-size: 20px;
    }
  </style>
</head>
<body>
<?php
   $this->load->view("menu");
  ?>
  <br>
  <div class="container">
    <h1><i class="bi bi-key-fill"></i> Administración de Roles</h1>
    <p style="margin-left: 20px;">Asignación y Gestión de Roles de Usuario</p>
    <div class="container text-center">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th id="gsts">BUSCAR POR ROL</th>
            <th id="gsts"> ASIGNAR ROL
            
              <i class="bi bi-info-circle" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer;"></i>
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="colormodal">Información</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="colormodal">
                    DESDE ESTA SECCIÓN, PUEDES ASIGNAR Y GESTIONAR LOS ROLES DE LOS USUARIOS. 
                    <br>
                    <br>
                     LOS CAMBIOS SE ACTUALIZARÁN DIRECTAMENTE EN LA BASE DE DATOS. 
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">¡Entendido!</button>
                    </div>
                  </div>
                </div>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <form method="post" id="frm_consulta" action="<?php echo site_url('roles/listar'); ?>">
              <td>
                <select id="roles" name="roles" class="form-select">
                  <option value="">Selecciona el rol actual</option>
                  <?php foreach ($roles as $r) { ?>
                    <option value="<?php echo isset($r['rol_id']) ? $r['rol_id'] : ''; ?>">
                      <?php echo isset($r['nombre']) ? $r['nombre'] : 'Nombre no disponible'; ?>
                    </option>
                  <?php } ?>
                </select>
              </td>
              <td> 
                <div class="alert alert-info" role="alert" id="alerta-seleccionado" style="display: none;">
                  SELECCIONASTE A: <span id="nombre-seleccionado"></span>
                </div>
              </td> 
            </form>
          </tr>
          <tr>
            <td>
              <div class="d-grid gap-2">
                <button type="submit" form="frm_consulta" class="btn btn-primary" id="buscarlupa">Buscar</button>
              </div>
            </td>
            <td>

              <?php 
            if ($this->session->flashdata('success')) { 
                echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
            } else {
                if ($this->session->flashdata('error')) { 
                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                }
            }
            ?>
            </td>
            </tr>
        </tbody>
    </table>

      <br>

      <table class="table table-bordered">
        <tr>
          <th id="gsts" class="col-lg-12 text-center">LISTA DE PERSONAS CON ESE ROL</th>
        </tr>
        <tr>
          <td>
            <div id="msj_error" class="alert alert-danger" style="display: none;">
              <h3 class="text-center">NO SE ENCONTRÓ COINCIDENCIA</h3>
            </div>
            <div id="msj_no_seleccion" class="alert alert-warning" style="display: none;">
              <h3 class="text-center">SELECCIONA UN ROL PARA BUSCAR</h3>
            </div>

            <div id="msj_no_encontrado" class="alert alert-danger" style="display: none;">
              <h3 class="text-center">¡NO SE ENCONTRÓ NINGUNA PERSONA CON ESTE ROL!</h3>
            </div>
          </td>
        </tr>
        <tr>
          <td>
      
            <?php foreach ($usuarios as $u) { ?>
              <div class="card rol-card rol_<?php echo isset($u['rol_id']) ? $u['rol_id'] : ''; ?>" style="display: none;">
                  <div class="card-body">
                      <h3>Información Solicitada</h3>
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>ID</th>
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
                                  <td><?php echo isset($u['rol_id']) ? $u['rol_id'] : ''; ?></td>
                                  <td><?php echo isset($u['rol_nombre']) ? $u['rol_nombre'] : 'Nombre no disponible'; ?></td>
                                  <td><?php echo isset($u['email']) ? $u['email'] : ''; ?></td>
                                  <td><?php echo isset($u['apellido']) ? $u['apellido'] : ''; ?></td>
                                  <td><?php echo isset($u['nombre']) ? $u['nombre'] : ''; ?></td>
                                  <td><?php echo isset($u['usuario']) ? $u['usuario'] : ''; ?></td>
                                  <td>
                                      <div class="dropdown">
                                          <button type="button" class="btn btn-primary btn-sm dropdown-toggle cambiarol" data-nombre="<?php echo isset($u['nombre']) ? $u['nombre'] : ''; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                              Cambiar Rol
                                          </button>
                                          <ul class="dropdown-menu">
                                              <li><a class="dropdown-item" href="<?php echo site_url('roles/cambiar_rol/' . $u['usuario_id'] . '/1'); ?>">Administrador</a></li>
                                              <li><a class="dropdown-item" href="<?php echo site_url('roles/cambiar_rol/' . $u['usuario_id'] . '/2'); ?>">Usuario</a></li>
                                              <li><a class="dropdown-item" href="<?php echo site_url('roles/cambiar_rol/' . $u['usuario_id'] . '/3'); ?>">Cliente</a></li>
                                          </ul>
                                      </div>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
            <?php } ?>
          </td>
        </tr>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  $(document).ready(function () {
    $('#buscarlupa').click(function (event) {
      event.preventDefault();
      var rolSeleccionado = $('#roles').val();
      var tarjetas = $(`.rol_${rolSeleccionado}`);
      var hayTarjetas = false;  
      $('.rol-card').hide(); 
      $('#msj_no_seleccion').hide();
      $('#msj_no_encontrado').hide();

      if (rolSeleccionado) {
        tarjetas.each(function () {
          hayTarjetas = true;
          return false; 
        });

        if (hayTarjetas) {
          tarjetas.show(); 
        } else {
          $('#msj_no_encontrado').show(); 
        }
      } else {
        $('#msj_no_seleccion').show(); 
      }
    });
  $(".cambiarol").click(function(document){
    var nombrePersona = $(this).data('nombre');
      $('#nombre-seleccionado').text(nombrePersona);
      $('#alerta-seleccionado').show();
    });
});
  </script>
</body>
</html>
