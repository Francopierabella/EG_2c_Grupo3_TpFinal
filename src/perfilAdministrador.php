<?php 
session_start();
include "consultaSql.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/StylesPerfilAdministrador.css?v=1.0">
    <link rel="stylesheet" href="Styles/StylesHeader.css?v=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Tu Perfil</title>
</head>
<body style="background-color: var(--azul)">
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
    <h1 id="panel">Panel de administrador</h1>

    <section id="gestion">
         <div class="card" style="width: 20rem; height: 15rem;">
            <div class="card-body">
                <h3 class="card-title"> Locales</h3>
                <div class="botones">
                    <a href="crearLocal.php" class="card-text">Crear</a>
                    <a href="editarLocal.php" class="card-text">Editar</a>
                    <a href="eliminarLocal.php" class="card-text">Eliminar </a>
                </div>
            </div>
         </div>
         <div class="card" style="width: 20rem; height: 15rem;">
            <div class="card-body">
                <h3 class="card-title"> Novedades</h3>
                <div class="botones">
                    <a href="crearNovedad.php" class="card-text">Crear</a>
                    <a href="editarNovedad.php" class="card-text">Editar</a>
                    <a href="eliminarNovedad.php" class="card-text">Eliminar </a>
                </div>
            </div>
         </div>
    </section>

    <section id="solicitudes">
        <hr style="color:white;">
        <?php
            $consulta = "SELECT * FROM promociones WHERE confirmado = 0";
            $resConsultaConf = consultaSql($consulta);
            $filas = mysqli_num_rows($resConsultaConf);
            if($filas == 0){
                echo "<h1 style='text-align: center;color: var(--blanco);text-decoration:underline; margin: 20px auto;'> No existen promociones a gestionar </h1>";
            }
            else{
                ?>
            <h1 style='text-align: center;color: var(--blanco);text-decoration:underline; margin: 20px auto;'> PROMOCIONES </h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Texto</th>
                        <th scope="col">Vence</th>
                        <th scope="col">Local</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <?php 
                while($fila = mysqli_fetch_assoc($resConsultaConf)){
                    ?>
                    <tr>
                        <td><?= $fila["codigoPromo"] ?></td>
                        <td><?= $fila["texto"] ?></td>
                        <td><?= $fila["fechaHasta"] ?></td>
                        <td><?= $fila['codigoLocal']?></td>
                        <td>
                            <form action="" method="post">
                                <button type="submit" name="aprobar" id="aprobar">✅</button>
                                <button type="submit" name="rechazar" id="rechazar">❌</button>
                            </form>
                        </td>
                        <?php 
                        if(isset($_POST['aprobar'])){
                            $promoAprobar = $fila['codigoPromo'];
                            $consulta = "UPDATE promociones SET confirmado = '1' WHERE codigoPromo = '$promoAprobar'";
                            $resConsulta = consultaSql($consulta);
                        }elseif(isset($_POST['rechazar'])){
                            $promoEliminar = $fila['codigoPromo'];
                            $consulta = "DELETE FROM promociones WHERE codigoPromo = '$promoEliminar'";
                            $resConsulta = consultaSql($consulta);
                        }
                        ?>
                    </tr>
            <?php
        }
        echo "</table>";
            ?>
                <?php } ?>
    </table>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>