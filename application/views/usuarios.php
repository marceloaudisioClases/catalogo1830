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
            <h1 class="display-1">Lista de Usuarios:</h1>
                        <div class="list-group">
                <?php foreach($usuarios as $u) { ?>
                  
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill-lock"></i> <?php echo $u["usuario"];?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"></i><b>Email: </b><?php echo $u["email"]; ?></a></li>
                <li><a class="dropdown-item" href="#"></i><b>Nombre: </b><?php echo $u["nombre"]; ?></a></li>
                <li><a class="dropdown-item" href="#"></i><b>Apellido: </b><?php echo $u["apellido"]; ?></a></li>
                <li><a class="dropdown-item" href="#"></i><b>Contraseña: </b><?php echo $u["password"]; ?></a></li>
                <li><a class="dropdown-item" href="#"></i><b>Creado: </b><?php echo $u["creado"]; ?></a></li>
                <li><a class="dropdown-item" href="#"></i><b>Ultimo ingreso: </b><?php echo $u["ult_login"]; ?></a></li>
            </ul>
            </li>
                  <br>
                <?php } ?>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>