<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/StylesInicio.css">
    <link rel="stylesheet" href="Styles/StylesHeader.css?v=1.0">
    <link rel="stylesheet" href="Styles/StylesFooter.css?v=1.0">
    <title>Inicio</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid header">
          <a class="navbar-brand" href="inicio.php"><img src="../assets/oh.png" alt=""></a>
          
          <!-- Botón hamburguesa -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <!-- Menú desplegable -->
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
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
          include "consultaSql.php";
          if (!isset($_SESSION ['usuario'])){
            echo '<a href="login.php" class="btn btn-outline-primary me-2" id="botonLogin">Iniciar Sesion</a>';
          }
          else{
            $usuarioLogueado = $_SESSION['usuario'];
            $consultaBDUsuario = "SELECT * FROM usuarios WHERE nombreUsuario = '$usuarioLogueado'";
            $resConsulta = consultaSql($consultaBDUsuario);
            if($resConsulta){
              $filaUsuario = mysqli_fetch_assoc($resConsulta);
              if ($filaUsuario['tipoUsuario'] == 'cliente'){
                echo '<a href="perfilCliente.php" class="btn btn-outline-primary me-2" id="botonLogin">Perfil</a>'; 
              }elseif($filaUsuario['tipoUsuario'] == 'dueño'){
                echo '<a href="perfilDueño.php" class="btn btn-outline-primary me-2" id="botonLogin" >Perfil</a>'; 
              }else{
                echo '<a href="perfilAdministrador.php" class="btn btn-outline-primary me-2" id="botonLogin" >Perfil</a>'; 
              }
              
            }
            echo '<a href="cerrarSesion.php" class="btn btn-outline-primary me-2" id="botonLogin">Cerrar sesion </a>'; 
          }
          ?>
        </div>
        <!-- Botones visibles solo dentro del menú colapsable -->
        <div class="d-sm-none text-center">
          <?php 
          if (!isset($_SESSION['usuario'])){
            echo '<a href="login.php" class="btn btn-outline-primary me-2" id="botonLogin">Iniciar Sesion</a>';
          }
          else{
            if ($filaUsuario['tipoUsuario'] == 'cliente'){
            }elseif($filaUsuario['tipoUsuario'] == 'dueño'){
              echo '<a href="perfilDueño.php" class="btn btn-outline-primary me-2" id="botonLogin" >Perfil</a>'; 
            }else{
              echo '<a href="perfilAdministrador.php" class="btn btn-outline-primary me-2" id="botonLogin" >Perfil</a>'; 
            }
            echo '<a href="cerrarSesion.php" class="btn btn-outline-primary me-2" id="botonLogin" >Cerrar sesion </a>';

            }
          
          ?>
        </div>
      </div>
    </div>
  </nav>
</header>
<section id="carousel">

  <?php   if(isset($_SESSION['usuario'])){
      $usuario = $_SESSION['usuario'];
      $consultaUsuario = "SELECT * FROM usuarios WHERE  nombreUsuario = '$usuario'";
      $res = consultaSql($consultaUsuario);
      $fila = mysqli_fetch_assoc($res);
      if($fila['tipoUsuario'] == 'cliente'){

        echo '<a href="#novedades" id="linkNov">Ver Novedades</a>'; }
      }?>
    <div class="w-75 mx-auto">
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../assets/InteriorShopping1.jpeg" class="d-block w-100" alt="Imagen del shopping">
            <div class="carousel-caption" id="first">
                <h5>Bienvenido a nuestro Shopping</h5>
                <p>Disfrutá de nuestras tiendas y promociones</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../assets/imagenShopping.jpg" class="d-block w-100" alt="Otra imagen el shopping">
            <div class="carousel-caption" id="second">
              <h5>Visita nuestras tiendas</h5>
              <p>Ofertas exclusivas todos los días</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../assets/InteriorShopping.jpeg" class="d-block w-100" alt="Otra imagen el shopping">
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
  </section>

    <?php 
    if(isset($_SESSION['usuario'])){
      $usuario = $_SESSION['usuario'];
      $consultaUsuario = "SELECT * FROM usuarios WHERE  nombreUsuario = '$usuario'";
      $res = consultaSql($consultaUsuario);
      if ($res){
        $filaUsuario = mysqli_fetch_assoc($res);
        if($filaUsuario['tipoUsuario'] == 'cliente'){
          if($filaUsuario['categoriaCliente'] == 'Inicial'){
            $novedades = "SELECT * FROM novedades WHERE fechaHasta >= CURDATE()";
            $resul = consultaSql($novedades); 
            ?>
          <section id="novedades">
            <div class="container-fluid novedades" >
              <?php
            if (mysqli_num_rows($resul) > 0){
              echo "<h1 style='color: black; text-align: center; margin: 10px;'>¡Las mejores novedades para vos!</h1>";
              while($novedad = mysqli_fetch_assoc($resul)){
                ?>
                  <div class="card" style="width: 18rem; height: 15rem;">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $novedad['titulo'] ?></h5>
                      <p class="card-text"><?php echo $novedad['texto'] ?></p>
                      <p class="card-text">Vigente hasta: <?php echo $novedad['fechaHasta'];?> </p>
                    </div>
                  </div>
                  
                  <?php 
          }
        }
        else{
          echo "<h2> No existen novedades. Vuelve pronto! </h2>"; 
        }
        
      }else if($filaUsuario['categoriaCliente'] == 'Medium'){
         $novedades = "SELECT * FROM novedades WHERE fechaHasta >= CURDATE() AND tipoUsuario != 'Medium'";
            $resul = consultaSql($novedades); 
            if (mysqli_num_rows($resul) > 0){
              while($novedad = mysqli_fetch_assoc($resul)){
                ?>
        
                  <div class="card" style="width: 18rem; height: 20rem;">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $novedad['titulo'] ?></h5>
                      <p class="card-text"><?php echo $novedad['texto'] ?></p>
                      <p class="card-text">
                        Vigente hasta: <?php echo $novedad['fechaHasta'];?>
                      </p>
                    </div>
                  </div>
                  
                  <?php 
          }
        }
        else{
          echo "<h2> No existen novedades. Vuelve pronto! </h2>"; 
        }
        
      }else{
         $novedades = "SELECT * FROM novedades WHERE fechaHasta >= CURDATE() AND tipoUsuario = 'Premium'";
            $resul = consultaSql($novedades); 
            if (mysqli_num_rows($resul) > 0){
              while($novedad = mysqli_fetch_assoc($resul)){
                ?>
        
                  <div class="card" style="width: 18rem; height: 20rem;">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $novedad['titulo'] ?></h5>
                      <p class="card-text"><?php echo $novedad['texto'] ?></p>
                      <p class="card-text">
                        Vigente hasta: <?php echo $novedad['fechaHasta'];?>
                      </p>
                    </div>
                  </div>
                  
                  <?php 
          }
        }
        else{
          echo "<h2> No existen novedades. Vuelve pronto! </h2>"; 
        }
        
    }
  }
  }}?>
    </div>

</section>

<footer>
  <div class="container-footer">
    <div class="footer-section contacto">
      <p>Realiza la consulta que quieras <a href="contacto.php">AQUÍ</a></p>
      <a href="#carousel" class="btn-subir">↑ Subir</a>
    </div>

    <div class="footer-section redes-sociales">
      <h3>¡Síguenos en nuestras redes sociales!</h3>
      <div class="redes">
        <a href="https://www.instagram.com/altorosario/">Instagram</a>
        <a href="https://www.facebook.com/">Facebook</a>
        <a href="https://x.com/home">Twitter / X</a>
      </div>
    </div>

    <div class="footer-section mapa">
      <h3>¡Encuéntranos aquí!</h3>
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1674.44573035326!2d-60.669001699999995!3d-32.9274658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95b654abc3ab1d5f%3A0x2f90ce97db2c5a6!2sAlto%20Rosario%20Shopping!5e0!3m2!1ses!2sar!4v1761943659459!5m2!1ses!2sar"  
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2025 Todos los derechos reservados</p>
    </div>
  </div>
</footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>