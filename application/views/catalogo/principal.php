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
        $this->load->view("catalogo/menu");
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
              <br>
              <div class="list-group">
                 <a href="<?php echo site_url("catalogo")?>" class="list-group-item list-group-item-action active">
                  <i class="bi bi-house-fill"></i> Inicio
                </a>
                <?php if (isset($buscar)) { ?>
                  <a href="*" class="list-group-item list-group-item-action active">
                  <i class="bi bi-house-fill"></i> Buscar
                </a>
              <?php } ?>
                <?php 
                if (isset($categoria_id)) {
                  if ($categoria_id> 0) {
                    $resaltar=$categoria_id;
                }else {
                  $resaltar=0;
                    }
                }else{
                    $resaltar=0;       
                }
                foreach($categorias as $c) { ?>
                  <a href="<?php echo site_url("catalogo/categeria/".$c["categoria_id"])?>" class="list-group-item list-group-item-action"><?php echo $c["nombre"];?></a>
                <?php } ?>
              </div>
            </div>
            <div class="col-10 nt-4">
            <?php if (isset($buscar)) { ?>
              <h1 class="display-3">Buscando: "<?php echo $buscar ?>"</h1>
              <?php }else{ ?>
                 <?php if ($categoria_id== 0) { ?>
                <h1 class="display-3">Catalogo</h1>
                <?php }else{ ?>
                <h1 class="display-3"><?php echo $categoria_seleccionada["icono"] ?> <?php echo $categoria_seleccionada["nombre"] ?></h1>
                 <?php } ?>
                <?php } ?>
                <br>
                <?php if ($productos) { ?>
                  <table class="table">
                    <tbody>
                      <?php foreach($productos as $p){ ?>
                      <tr>
                        <th scope="row"></th>
                        <?php if(file_exists(FCPATH.DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR.$p["producto_id"]."png")) { ?>
                          <img src="<?php echo base_url("img/".$p["producto_id"].".png") ?>" class="img-fluid">
                        <?php }else{ ?>
                            <img src="<?php echo base_url("img/sin-imagen.png") ?>" class="img-fluid">
                        <?php } ?>
                        <td>
                          <?php str_pad($p["producto_id"], 5, "0", STR_PAD_LEFT)?> - <?php echo $p["nombre"] ?>
                          <button type="*" class="btn btn-outline-primary btn-sm">+info</button>
                        </td>
                        <td class="text-end"><b>$<?php echo $p["costo"] ?></b></td>                    
                      </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php }else{ ?>
                  <?php if (isset($buscar)) { ?>
                      <div class="alert alert-warning">
                          No hay productos que coincidan con la busqueda!
                      </div>
                    <?php }else{ ?>
                      <?php ($categoria_id>0) ?>
                        <div class="alert alert-info">
                         No hay productos en esta categoria!
                        </div>
                  <?php } ?>
                 <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>