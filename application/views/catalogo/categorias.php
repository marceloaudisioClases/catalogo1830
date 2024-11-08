<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tabla de categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center">Categorias disponibles:</h1>
    <div class="container">
      <div class="row">
        <div class="col-4 offset-4">
          <div class="card">
            <div class="card-body">
                <table cellpading="5" cellspacing="5">
                  <thead>
                      <tr>
                      <th>Nombre de categoria&nbsp;&nbsp;&nbsp;</th>
                      <th>Estado</th>
                      </tr>
                  </thead>
                  <?php if($categorias>0){ ?>
                  <?php foreach ($categorias as $c){  ?>
                  <tbody>
                      <tr>
                      <td><?php echo $c["nombre"]; ?></td>
                      <td><?php echo $c["estado"]; ?></td>
                      </tr>
                  </tbody>
                  <?php } ?>
                  <?php } ?>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>