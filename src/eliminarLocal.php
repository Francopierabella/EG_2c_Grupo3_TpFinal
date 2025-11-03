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
    <link rel="stylesheet" href="Styles/StylesEliminar.css">
    <title>Eliminar Locales</title>
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
    <?php 
    $consulta = "SELECT * FROM locales";
    $resConsulta = consultaSql($consulta);
    $filas = mysqli_num_rows($resConsulta);
    if($filas == 0){
        echo "<h1 style= 'text-align:center; color:var(--blanco);text-decoration:underline;'> No existes Locales! </h1>";
    }
    else{
        ?>
        <h1 style= "text-align:center; color:var(--blanco);text-decoration:underline; margin: 50px auto;>" >Locales</h1>
        <table>
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ubicacion</th>
                    <th scope="col">Dueño</th>
                    <th scope="col">Accion</th>

                </tr>
            </thead>
            <?php 
                while($fila = mysqli_fetch_assoc($resConsulta)){
                    ?>
                    <tr>
                        <td><?= $fila['codigoLocal']?></td>
                        <td><?= $fila['nombre']?></td>
                        <td><?= $fila['ubicacion']?></td>
                        <td><?= $fila['codUsuario']?></td>
                        <td>
                            <form action="" method="post">
                                <button type="submit" name="eliminar" id="eliminar" >❌</button>
                            </form>
                        </td>
                    </tr>
               <?php } ?>
        </table>
    <?php }?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
                    <?php 
                    if(isset($_POST['eliminar'])){
                        $codigoLocal = $fila['codigoLocal'];
                        $consulta = "DELETE FROM locales WHERE codigoLocal = '$codigoLocal'";
                        $resConsultaDelete = consultaSql($consulta);
                        header("Location: eliminarLocal.php");
                    }
                    ?>
    
</body>
</html>