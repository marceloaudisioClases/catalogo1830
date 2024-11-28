<nav class="navbar bg-dark border-bottom border-body navbar-expand-lg" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="bi bi-magic"></i> App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="#"><i class="bi bi-house-fill"></i> Inicio</a>
        </li>
      </ul>
      <form class="d-flex" role="search" method="POST" action="<?php echo site_url("catalogo/buscar"); ?>">
        <input class="form-control me-2" type="text" placeholder="Ej: Modelo" name="buscar" value="<?php echo (isset($buscar))?$buscar:"";?>">
        <button class="btn btn-primary" type="submit">Buscar</button>
      </form>
      <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i> <?php echo $this->session->userdata("nombre")." ".$this->session->userdata("apellido") ?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo site_url("principal/micuenta"); ?>"><i class="bi bi-briefcase-fill"></i> Mi cuenta</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?php echo site_url("auth/logout"); ?>"><i class="bi bi-door-open-fill"></i> Salir</a></li>
            </ul>
            </li>
        </ul>
    </div>
  </div>
</nav>