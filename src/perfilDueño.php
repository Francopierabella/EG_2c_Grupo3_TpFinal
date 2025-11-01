<?php 
session_start();
include "consultaSql.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                echo '<a href="perfilDueño.php" class="btn btn-outline-primary me-2" id="botonLogin" >Perfil</a>'; 
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
</body>
</html>