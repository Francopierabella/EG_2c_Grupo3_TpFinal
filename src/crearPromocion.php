<?php 
session_start();
include "consultaSql.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=}, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/StylesCrearPromocion.css">
    <link rel="stylesheet" href="Styles/StylesHeader.css?v=1.0">
    <title>Crear Promocion</title>
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

<main>
    <h1>Ingresa los datos de la nueva promocion</h1>
    <form action="" method="post">
            <label for="textoPromocion">Descripcion:</label>
            <input type="text" name="texto" required>
            <label for="FechaDesde">FechaDesde:</label>
            <input type="date" name="desde"required >
            <label for="FechaHasta">FechaHasta:</label>
            <input type="date" name="hasta" required>
            <label for="textoPromocion">CategoriaCliente:</label>
            <select name="categoriaCliente" required>
                <option value="Inicial">Inicial</option>
                <option value="Medium">Medium</option>
                <option value="Premium">Premium</option>
            </select>
            <label for="dias que aplica">Dias que aplica: </label>
            <select name="dias[]" multiple required>
                <option value="0">Domingo</option>
                <option value="1">Lunes</option>
                <option value="2">Martes</option>
                <option value="3">Miercoles</option>
                <option value="4">Jueves</option>
                <option value="5">Viernes</option>
                <option value="6">Sabado</option>
            </select>
            <label for="codigoLocal">Tu local: </label>
            <input type="number" name="codLocal" required>
            <button type="submit">Crear Promocion</button>
    </form>
<a href="promociones.php" id="linkAPromos">Ir a promociones</a>
</main>
<?php 
    if(isset($_POST['texto'])&& isset($_POST['desde']) && isset($_POST['hasta'])&& isset($_POST['categoriaCliente'])&& isset($_POST['dias'])
         && isset($_POST['codLocal'])){
        $codLocal = $_POST['codLocal'];
        $consulta = "SELECT * FROM locales WHERE codigoLocal = '$codLocal'";
        $res = consultaSql($consulta);
        if(mysqli_num_rows($res) == 0){
            echo "<h1> No existe ese local. Ingresa de nuevo tus datos! </h1>";
        }else{
        $text = $_POST['texto'];
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        $catCliente = $_POST['categoriaCliente'];
        $dias = $_POST['dias'];
        $diasString = implode(',',$dias);
        $idDueño = $_SESSION['id'];
        $consulta = "INSERT INTO promociones (texto,fechaDesde,fechaHasta,categoriaCliente,estado,codigoLocal,diaSemana,confirmado)
            VALUES ('$text','$desde','$hasta','$catCliente','sinSolicitar','$codLocal','$diasString',0)";
        $res = consultaSql($consulta);
        echo "<h1> Promocion creada Correctamente! </h1>";
        header("Location: promociones.php");

    }}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>