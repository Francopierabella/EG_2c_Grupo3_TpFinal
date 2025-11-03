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
    <link rel="stylesheet" href="Styles/StylesEditarNovedades.css?v=1.0">
    <title>Editar Novedades </title>
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
    <h1>Editar Novedad</h1>
    <form action="" method="post">
        <label for="codigoNovedad">Codigo Novedad a Modificar: </label>
        <input type="number" name="codigoNov" required>
        <label for="titulo">Titulo: </label>
        <input type="text" name="titulo" required>
        <label for="texto">Descripcion: </label>
        <input type="text" name="texto" required>
        <label for="fechaDesde">fechaDesde: </label>
        <input type="date" name="desde" required>
        <label for="hasta">fechaHasta: </label>
        <input type="date" name="hasta">
        <label for="tipoUsuario">TipoUsuario </label>
        <select name="tipo" >
            <option value="Inicial">Inicial</option>
            <option value="Medium">Medium</option>
            <option value="Premium">Premium</option>
        </select>
        <button type="submit">Editar Novedad</button>
    </form>
</main>
<?php 
if(isset($_POST['codigoNov'])
    && isset($_POST['titulo'])
    && isset($_POST['texto'])
    && isset($_POST['desde'])
    && isset($_POST['hasta'])
    && isset($_POST['tipo'])){
        $novedadAeditar = $_POST['codigoNov'];
        $consulta = "SELECT * FROM novedades WHERE codigo = '$novedadAeditar'";
        $resConsulta = consultaSql($consulta);
        $filas = mysqli_num_rows($resConsulta);
        if($filas == 0){
            echo "<h1 style='text-align:center;color:var(--blanco);text-decoration:underline;'> 
                            No existe ese codigo de novedad! Intenta nuevamente</h1>";
        }else{
            $titulo = $_POST['titulo'];
            $texto = $_POST['texto'];
            $desde = $_POST['desde'];
            $hasta = $_POST['hasta'];
            $tipo = $_POST['tipo'];
            $consulta = "UPDATE novedades SET titulo = '$titulo',texto = '$texto',fechaDesde = '$desde',fechaHasta = '$hasta',tipoUsuario = '$tipo' WHERE codigo = '$novedadAeditar'";
            $resConsulta = consultaSql($consulta);
            echo "<h1 style='text-align:center;color:var(--blanco);text-decoration:underline;'> 
                           Novedad Creada Correctamente!</h1>";
            header("Location: perfilAdministrador.php");
        }

    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>