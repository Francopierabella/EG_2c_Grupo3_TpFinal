<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/StylesInicio.css">
    <title>Inicio</title>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-md bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="../assets/oh.png" alt=""></a>

      <!-- Botón hamburguesa -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Menú desplegable -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-sm-0 text-center">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Promociones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacto</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" id="sobreNosotros" href="#">Sobre Nosotros</a>
          </li>
        </ul>
        <div class="d-none d-sm-flex ms-auto">
          <?php 
          session_start();
          if (!isset($_SESSION ['usuarioId'])){
            echo '<a href="login.php" class="btn btn-outline-primary me-2" id="botonLoginRegister">Login</a>';
            echo '<a href="register.php" class="btn btn-primary" id="botonLoginRegister">Register</a>';
          }
          else{
            echo '<a href="cerrarSesion.php" class="btn btn-outline-primary me-2">Cerrar sesion </a>'; 
          }
          ?>
        </div>
        <!-- Botones visibles solo dentro del menú colapsable -->
        <div class="d-sm-none text-center">
          <?php 
          if (!isset($_SESSION ['usuarioId'])){
            echo '<a href="login.php" class="btn btn-outline-primary me-2">Login</a>';
            echo '<a href="register.php" class="btn btn-primary">Register</a>';
          }
          else{
            echo '<a href="cerrarSesion.php" class="btn btn-outline-primary me-2">Cerrar sesion </a>'; 
          }
          ?>
        </div>
      </div>
    </div>
  </nav>
</header>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>