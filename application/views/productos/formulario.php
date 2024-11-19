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
              
                <h1>Alta de producto:</h1>
                <?php echo validation_errors(); ?>
                <div class="card">
                    <div class="card-body">
                    <form method="post" action="<?php echo site_url("productos/alta"); ?>">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value("nombre"); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo set_value("descripcion"); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="categoria_id" class="form-label">Categoría</label>
                            <select class="form-select" id="categoria_id" name="categoria_id">
                                <option selected>Seleccione una categoría</option>
                                <?php foreach($categorias as $c){ ?>
                                    <option value="<?php echo $c["categoria_id"]; ?>"><?php echo $c["nombre"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="stock_actual" class="form-label">Stock Actual</label>
                            <input type="number" class="form-control" id="stock_actual" name="stock_actual" value="<?php echo set_value("stock_actual"); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="stock_min" class="form-label">Stock Mínimo</label>
                            <input type="number" class="form-control" id="stock_min" name="stock_min" value="<?php echo set_value("stock_min"); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="costo" class="form-label">Costo</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="costo" name="costo" value="<?php echo set_value("costo"); ?>">
                            </div>
                        </div>        
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>