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
                <a href="<?php echo site_url("catalogo"); ?>" class="list-group-item list-group-item-action <?php 
                if(isset($categoria_id)){
                  if($categoria_id==0){
                    echo "active";
                  }
                } 
                ?>">
                  <i class="bi bi-house-fill"></i> Inicio
                </a>
                <?php 
                if(isset($categoria_id)){
                  if($categoria_id> 0){
                    $resaltar=$categoria_id;
                  }else{
                    $resaltar=0;
                  }
                }else{
                  $resaltar=0;
                }
                foreach($categorias as $c) { ?>
                  <a href="<?php echo site_url("catalogo/categoria/".$c["categoria_id"]); ?>" class="list-group-item list-group-item-action <?php echo ($resaltar==$c["categoria_id"])?"active":""; ?>"><?php echo $c["icono"];?> <?php echo $c["nombre"];?></a>
                <?php } ?>
              </div>
            </div>
            <div class="col-10 mt-4">
            <?php if($producto){ ?>
                <?php if($categoria_id==0){ ?>
                  <h1 class="display-3"> Sin Categoria - <?=$producto["nombre"]?></h1>
                <?php }else{ ?>
                  <h1 class="display-3"> <?php echo $categoria_seleccionada["icono"]; ?> <?php echo $categoria_seleccionada["nombre"]; ?> - <?=$producto["nombre"]?></h1>
                <?php } ?>
            
                <br>

                <div class="card col-sm-8">
                <?php if(file_exists(FCPATH.DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR.$producto["producto_id"].".png")){ ?>
                    <img src="<?php echo base_url("img/".$producto["producto_id"].".png")?>" class="img-fluid card-img-top">
                <?php }else{ ?>	
                    <img src="<?php echo base_url("img/sin-imagen.png")?>" class="img-fluid card-img-top">
                <?php } ?>
                
                <div class="card-body">
                    <h3 class="card-title">
                    <?=str_pad($producto["producto_id"],5,"0",STR_PAD_LEFT)?> - <?=$producto["nombre"]?>
                    </h3>
                    <p class="card-text"><?=$producto["descripcion"]?></p>
                    <h4 class="float-end">Precio Final +IVA $<?=$producto["costo"]?></h4>
                    <p class="col-sm-2">
                      <img src="<?php echo base_url("img/qr/".$producto["producto_id"].".png")?>" class="img-fluid">
                    </p>
                </div>
                </div>
                <br>  
                <?php }else{ ?>
                  
                    
                        <div class="alert alert-info">
                            El Producto no Existe
                        </div>
                    
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>