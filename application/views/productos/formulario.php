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
              
                <h1>Alta de Producto:</h1>
                <?php echo validation_errors(); ?>
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo site_url ("productos/alta"); ?>" method="post">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" ><br><br>

                            <label for="descripcion">Descripción:</label>
                            <textarea id="descripcion" name="descripcion"></textarea><br><br>

                            <label for="categoria_id">Categoría:</label>
                            <select id="categoria_id" name="categoria_id">
                                <option value="1">Categoría 1</option>
                                <option value="2">Categoría 2</option>
                                <option value="3">Categoría 3</option>
                           </select><br><br>

                            <label for="stock_actual">Stock Actual:</label>
                            <input type="number" id="stock_actual" name="stock_actual"><br><br>

                            <label for="stock_min">Stock Mínimo:</label>
                            <input type="number" id="stock_min" name="stock_min"><br><br>

                            <label for="costo">Costo:</label>
                            <input type="number" step="0.01" id="costo" name="costo"><br><br>

                            <button type="submit">Enviar</button>
                       </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>