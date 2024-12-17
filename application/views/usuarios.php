<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenida de usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">  
  </head>
  <body>
    <?php
        $this->load->view("menu");
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
            <h1 class="display-1">Lista de Usuarios:
              <span class="float-end">
                <a href="#" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nuevo</a>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Herramientas
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo site_url("usuarios/exportar_csv_usuarios");?>">Exportar CSV</a></li>
                    </ul>
                </div>
              </span>
            </h1>
                <table class="table">
                <thead>
                    <tr>
                    <th class="col-sm-1">
                    <a href="<?php echo site_url("usuarios/listar/orden/usuario_id");?>">ID</a>
                    </th>
                    <th>
                    <a href="<?php echo site_url("usuarios/listar/orden/usuario");?>">Usuario</a>
                    </th>
                    <th>
                    <a href="<?php echo site_url("usuarios/listar/orden/nombre");?>">Nombre</a>
                    </th>
                    <th>
                    <a href="<?php echo site_url("usuarios/listar/orden/apellido");?>">Apellido</a>
                    </th>
                    <th>
                    <a href="<?php echo site_url("usuarios/listar/orden/email");?>">Email</a>
                    </th>
                    <th>
                    <a href="<?php echo site_url("usuarios/listar/orden/rol_id");?>">Rol</a>
                    </th>
                    <th class="col-sm-2 text-end">
                    <a href="<?php echo site_url("usuarios/listar/orden/ult_login");?>">Último inicio</a>
                    </th>
                    <th>
                    <a href="<?php echo site_url("usuarios/listar/orden/estado");?>">Estado</a>
                    </th>
                    <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $u){ ?>
                        <tr>
                            <th scope="row"><?=str_pad($u["usuario_id"],5,"0",STR_PAD_LEFT)?></th>
                            <td><?=$u["usuario"]?></td>
                            <td><?=$u["nombre"]?></td>
                            <td><?=$u["apellido"]?></td>
                            <td><?=$u["email"]?></td>
                            <td><?=$u["rol_nombre"]?></td>
                            <td class="text-end"><?=$u["ult_login"]?></td>

                              <?php switch ($u["estado"]) {
                                case '1':
                                  echo "<td>Activo</td>";
                                  break;
                                case '0':
                                  echo "<td>Inactivo</td>";
                                  break;
                                case '-1':
                                  echo "<td>Pendiente</td>";
                                  break;
                              }?>
                            
                            <td class="text-end">
                             <a href="#" class="btn btn-primary btn-sm" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>