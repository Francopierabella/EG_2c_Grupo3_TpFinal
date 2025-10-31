<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/StylesInicio.css?v=1.0">
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
            <a class="nav-link" href="promociones.php">Promociones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contacto.php">Contacto</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" id="sobreNosotros" href="sobreNosotros.php">Sobre Nosotros</a>
          </li>
        </ul>
        <div class="d-none d-sm-flex ms-auto">
          <?php 
          session_start();
          if (!isset($_SESSION ['usuario'])){
            echo '<a href="login.php" class="btn btn-outline-primary me-2" id="botonLogin">Iniciar Sesion</a>';
          }
          else{
            echo '<a href="cerrarSesion.php" class="btn btn-outline-primary me-2" id="botonLogin">Cerrar sesion </a>'; 
          }
          ?>
        </div>
        <!-- Botones visibles solo dentro del menú colapsable -->
        <div class="d-sm-none text-center">
          <?php 
          session_start();
          if (!isset($_SESSION['usuario'])){
            echo '<a href="login.php" class="btn btn-outline-primary me-2">Iniciar Sesion</a>';
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
  <main>
    <div class="w-75 mx-auto">
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../assets/InteriorShopping1.jpeg" class="d-block w-100" alt="...">
            <div class="carousel-caption" id="first">
                <h5>Bienvenido a nuestro Shopping</h5>
                <p>Disfrutá de nuestras tiendas y promociones</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../assets/imagenShopping.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption" id="second">
              <h5>Visita nuestras tiendas</h5>
              <p>Ofertas exclusivas todos los días</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../assets/InteriorShopping.jpeg" class="d-block w-100" alt="...">
            <div class="carousel-caption" id="third">
              <h5>Disfrutá de la experiencia</h5>
              <p>Ambiente moderno y cómodo para vos</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <h1>gholl </h1>
  </main>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>