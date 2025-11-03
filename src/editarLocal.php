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
    <link rel="stylesheet" href="Styles/StylesEditarLocales.css?v=1.0">
    <title>Editar Locales</title>
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
    <h1>Edita el Local!</h1>
    <form action="" method="post">
        <label for="codigoLocal">Codigo del Local a Modificar: </label>
        <input type="number" name="codigoLocal" required>
        <label for="nombreLocal">Nombre: </label>
        <input type="text" name="nombre" required>
        <label for="ubicacion">Ubicacion: </label>
        <input type="text" name="ubicacion" required>
        <label for="rubro">Rubro: </label>
        <input type="text" name="rubro" >
        <label for="codigoDueño">Codigo del dueño: </label>
        <input type="number" name="codigo" required>
        <button type="submit">Editar Local</button>
    </form>
</main>
<?php 
 if(isset($_POST['nombre']) &&
        isset($_POST['ubicacion']) && 
            isset($_POST['rubro']) && 
                isset($_POST['codigo'])&& 
                    isset($_POST['codigoLocal'])){
                $codigoDelLocalAModificar = $_POST['codigoLocal'];
                $consulta = "SELECT * FROM locales WHERE codigoLocal = '$codigoDelLocalAModificar'";
                $resConsulta = consultaSql($consulta);
                $filasLocales = mysqli_num_rows($resConsulta);
                $idIngresado = $_POST['codigo'];
                $consulta = "SELECT * FROM usuarios WHERE idUsuario = '$idIngresado'";
                $resConsulta = consultaSql($consulta);
                $filasUsuarios = mysqli_num_rows($resConsulta);
                if ($filasLocales == 0 or $filasUsuarios == 0){
                    echo "<h1 style='text-align:center;color:var(--blanco);text-decoration:underline;'> 
                            Datos Inválidos! Chequea los codigos!</h1>";
                }
                else{
                    $nuevoNombre = $_POST['nombre'];
                    $nuevaUbi = $_POST['ubicacion'];
                    $nuevoRubro = $_POST['rubro'];
                    $nuevoDueño = $_POST['codigo'];
                    $consulta = "UPDATE locales SET 
                    nombre = '$nuevoNombre', 
                    ubicacion = '$nuevaUbi',
                    rubro = '$nuevoRubro',
                    codUsuario = '$nuevoDueño' 
                    WHERE codigoLocal = '$codigoDelLocalAModificar'
                    "    ;
                    $resConsulta = consultaSql($consulta);
                    echo "<h1 style='text-align:center;color:var(--blanco);text-decoration:underline;'> 
                            Local editado correctamente!</h1>";

                }
            }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>