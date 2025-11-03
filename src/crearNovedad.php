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
    <link rel="stylesheet" href="Styles/StylesHeader.css?v=1.0">
    <link rel="stylesheet" href="Styles/StylesCrearNovedad.css">
    <title>Crear Novedad</title>
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
                    <a class="nav-link" aria-current="page" href="inicio.php">Inicio</a>
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
                    echo '<a href="perfilAdministrador.php" class="btn btn-outline-primary me-2" id="botonLogin" >Perfil</a>'; 
                    echo '<a href="cerrarSesion.php" class="btn btn-outline-primary me-2" id="botonLogin" >Cerrar sesion </a>';

            ?>
            </div>
            <!-- Botones visibles solo dentro del menú colapsable -->
            <div class="d-sm-none text-center">
            <?php 
                echo '<a href="cerrarSesion.php" class="btn btn-outline-primary me-2" id="botonLogin" >Cerrar sesion </a>';
            ?>
            </div>
            </div>
         </div>
        </nav>
    </header> 
<main>
    <h1>Crea un nuevo novedad!</h1>
    <form action="" method="post">
        <label for="titulo">Titulo </label>
        <input type="text" name="titulo" required>
        <label for="texto">Descripcion: </label>
        <input type="text" name="texto" required>
        <label for="desde">FechaDesde </label>
        <input type="date" name="desde" required>
        <label for="hasta">fechaHasta </label>
        <input type="date" name="hasta" required>
        <label for="tipoUsuario">
            <select name="tipo"required >
                <option value="Inicial">Inicial</option>
                <option value="Medium">Medium</option>
                <option value="Premium">Premium</option>
            </select>
        </label>
        <button type="submit"> Crear novedad</button>
    </form>
</main>
<?php 
    if(isset($_POST['titulo']) &&
        isset($_POST['texto']) && 
        isset($_POST['desde']) &&
        isset($_POST['hasta']) &&
        isset($_POST['tipo'])){
            $titulo = $_POST['titulo'];
            $texto = $_POST['texto'];
            $desde = $_POST['desde'];
            $hasta = $_POST['hasta'];
            $tipo = $_POST['tipo'];
            $consulta = "INSERT INTO novedades (titulo,texto,fechaDesde,fechaHasta,tipoUsuario) 
                VALUES ('$titulo','$texto','$desde','$hasta','$tipo')";
                $resConsulta = consultaSql($consulta);
            echo "<br>";
            echo "<h1 style='text-align:center; margin: 20px auto; color: var(--blanco);' >Novedad Creada Con exito! </h1>";
        }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>