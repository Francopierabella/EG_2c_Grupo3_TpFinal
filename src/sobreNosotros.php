<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/StylesSobreNosotros.css">
    <title>Sobre Nosotros</title>
</head>
<body>
    <header>
      <nav class="navbar navbar-expand-md bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand" href="inicio.php"><img src="../assets/oh.png" alt="Logo shopping / Boton Home"></a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Menú desplegable -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0 text-center">
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
        <div class="container">
            <p>Bienvenido a OnixCenter, un supermercado pensado para acompañarte todos los días.
                Nuestra historia comenzó con una idea simple: ofrecer productos de calidad al mejor precio, 
                en un espacio moderno, cómodo y con atención personalizada.
            </p>
                <br><hr>
            <p>
                Desde nuestros primeros pasos, apostamos a combinar la cercanía de un comercio de barrio 
                con la eficiencia de las nuevas tecnologías. Hoy, gracias a nuestro sistema digital,
                 nuestros clientes pueden acceder a promociones exclusivas, 
                conocer las novedades más recientes y realizar sus compras con total comodidad.
            </p>
                <br><hr>
            <p>
                En OnixCenter, creemos que la innovación y la confianza van de la mano.
                 Por eso trabajamos junto a pequeños y grandes productores,
                  impulsando el consumo responsable y fomentando el desarrollo local.
            </p>
                <br><hr>

            <p>
                Nuestra misión es hacerte la vida más fácil, ofreciéndote una experiencia de compra práctica, segura y transparente.
            </p>
            <br> <hr>
            <p>
            Nuestro compromiso es seguir creciendo junto a vos, mejorando cada día 
            para que encuentres todo lo que necesitás en un solo lugar.
            </p>
            <p>
                Gracias por elegirnos. <br>
            <strong>OnixCenter - Tu supermercado de confianza.</strong>
            </p>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>