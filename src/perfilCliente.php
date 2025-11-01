<?php 
session_start();
include "consultaSql.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/StylesPerfilCliente.css?v=1.0">
    <title>Tu Perfil</title>
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
              }else if($filaUsuario['tipoUsuario'] == 'dueño'){
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
            echo '<a href="cerrarSesion.php" class="btn btn-outline-primary me-2" id="botonLogin" >Cerrar sesion </a>';
            echo '<a href="perfilCliente.php" class="btn btn-outline-primary me-2" id="botonLogin">Perfil</a>'; 
            $usuarioLogueado = $_SESSION['usuario'];
            $consultaBDUsuario = "SELECT * FROM usuarios WHERE nombreUsuario = '$usuarioLogueado'";
            $resConsulta = consultaSql($consultaBDUsuario);
            if($resConsulta){
              $filaUsuario = mysqli_fetch_assoc($resConsulta);
              if ($filaUsuario['tipoUsuario'] == 'cliente'){
              }else if($filaUsuario['tipoUsuario'] == 'dueño'){
              echo '<a href="perfilDueño.php" class="btn btn-outline-primary me-2" id="botonLogin" >Perfil</a>'; 
              }else{
              echo '<a href="perfilAdministrador.php" class="btn btn-outline-primary me-2" id="botonLogin" >Perfil</a>'; 
            }

            }
            else{
              echo "<h1> ERROR EN CONSULTA</h1>";
            }

          }
          ?>
        </div>
      </div>
    </div>
  </nav>
</header>
<section class="datosCliente">
    <h1>Datos personales </h1>
    <div class="datos">
          <?php 
          $usuario = $_SESSION['usuario'];
          $consulta = "SELECT * FROM usuarios WHERE nombreUsuario = '$usuario'";
          $resConsulta = consultaSql($consulta);
          if($resConsulta){
            $filaUsuario = mysqli_fetch_assoc($resConsulta);
            ?>
            <h2>Email: <?php echo $filaUsuario['nombreUsuario']?> </h2>
                <?php 
                $codigoCliente = $filaUsuario['idUsuario'];
                $consulta = "SELECT * FROM uso_Promociones WHERE codigoCliente = '$codigoCliente'";
                $resConsulta = consultaSql($consulta);
                if($resConsulta){
                    $cantidadPromociones = mysqli_num_rows($resConsulta);
                    if($cantidadPromociones >= 3 && $cantidadPromociones <= 6){
                       $consulta = "UPDATE usuarios SET categoriaCliente = 'Medium' WHERE idUsuario = '$codigoCliente'";
                       $resConsulta = consultaSql($consulta);
                    }
                    else if($cantidadPromociones > 6){
                        $consulta = "UPDATE usuarios SET categoriaCliente = 'Premium' WHERE idUsuario = '$codigoCliente'";
                        $resConsulta = consultaSql($consulta);
                    }
                }

                
            ?>
            <h3>Categoria Actual: <?php echo $filaUsuario['categoriaCliente'];?></h3>
            <?php 
                if($filaUsuario['categoriaCliente'] != 'Premium'){

                    ?>
                    <label for="">Progeso hacia Premium</label>
                <progress max="10" <?php echo "value= '$cantidadPromociones'"?>></progress>
               <?php  }?>
            
        <?php  }?>
    </div>

</section>
<section class="promocionesUsadas">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>John</td>
      <td>Doe</td>
      <td>@social</td>
    </tr>
  </tbody>
</table>            

</section>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
</body>
</html>