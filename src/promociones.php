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
    <link rel="stylesheet" href="Styles/StylesPromociones.css">
    <link rel="stylesheet" href="Styles/StylesHeader.css?v=1.0">
    <link rel="stylesheet" href="Styles/StylesFooter.css?v=1.0">
    <title>Promociones</title>
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
    <div class="container">
        <?php 
            if(isset($_SESSION['id'])){
                $id = $_SESSION['id'];
                $consultaUsuario = "SELECT * FROM usuarios WHERE idUsuario = '$id'";
                $resConsulta = consultaSql($consultaUsuario);
                $usuario = mysqli_fetch_assoc($resConsulta);
                $tipoUsuario = $usuario['tipoUsuario'];
                if($tipoUsuario == 'cliente'){
                    $diaHoy = date('w');
                    $hoy = date('Y-m-d');
                    $categoriaCliente = $usuario['categoriaCliente'];
                    if($categoriaCliente == 'Inicial'){
                        $consultaPromociones = "SELECT * FROM promociones WHERE categoriaCliente = 'Inicial' AND fechaHasta >= CURDATE() AND estado = 'sinSolicitar' AND FIND_IN_SET('$diaHoy', diaSemana) AND confirmado = '1'";
                    }elseif($categoriaCliente == 'Medium'){
                        $consultaPromociones = "SELECT * FROM promociones WHERE (categoriaCliente = 'Inicial' OR categoriaCliente = 'Medium') AND fechaHasta >= CURDATE() AND estado = 'sinSolicitar'AND FIND_IN_SET('$diaHoy', diaSemana) AND confirmado = '1'";
                    }else{
                        $consultaPromociones = "SELECT * FROM promociones WHERE fechaHasta >= CURDATE() AND estado = 'sinSolicitar' AND FIND_IN_SET('$diaHoy', diaSemana) AND confirmado = '1'";
                    }
                    $resConsultaPromos = consultaSql($consultaPromociones);
                    $cantPromos = mysqli_num_rows($resConsultaPromos);
                    if($cantPromos == 0){
                        echo "<h1> No hay promociones! Vuelve mas tarde</h1>";
                    }
                    else{
                        ?>
                        <table>
                            <thead>
                             <tr>
                               <th scope="col">CodigoPromocion</th>
                               <th scope="col">Descripcion</th>
                               <th scope="col">Valida hasta</th>
                               <th scope="col">Dias que aplica</th>
                               <th scope="col">Solicitar</th>
    
                             </tr>
                           </thead>
                           <?php 
                           while($promocion = mysqli_fetch_assoc($resConsultaPromos)){
                               ?>
                                <tr>
                                    <td><?= $promocion["codigoPromo"] ?></td>
                                    <td><?= $promocion["texto"] ?></td>
                                    <td><?= $promocion["fechaHasta"]?></td>
                                    <td><?php $dias = explode(',', $promocion['diaSemana']); 
                                                    $nombresDias = [
                                                            '0' => 'Domingo',
                                                            '1' => 'Lunes',
                                                            '2' => 'Martes',
                                                            '3' => 'Miércoles',
                                                            '4' => 'Jueves',
                                                            '5' => 'Viernes',
                                                            '6' => 'Sábado'
                                                    ];
                                                        $diasTexto = array_map(fn($d) => $nombresDias[$d], $dias);
    
                                            // los unimos con coma o guion
                                            echo implode(', ', $diasTexto);?></td>
                                    <td>
                                        <form action="" method="post">
                                            <button type="submit" name="solicitar">✅</button>
                                        <?php 
                                        if(isset($_POST['solicitar'])){
                                            $codPromo = $promocion["codigoPromo"];
                                            $fechaUso = date('Y/m/d');
                                            $consulta = "UPDATE promociones SET estado = 'pendiente' WHERE codigoPromo = '$codPromo'";
                                            $resConsulta = consultaSql($consulta);
                                            header("Location: promociones.php");
                                            $consulta = "INSERT INTO uso_promociones (codigoCliente,codigoPromocion,fechaDeUso,estado) 
                                            VALUES ('$id','$codPromo','$fechaUso','pendiente')";
                                            $resConsulta = consultaSql($consulta);
                                        }
                                        ?>
                                        </form>
                                    </td>
    
                                </tr>   
                            <?php
                }
                echo "</table>";
                ?>
                   <?php }?>
        
             <?php }elseif ($tipoUsuario == 'dueño') {
                    $idDueño = $usuario['idUsuario'];
                    $consulta = "SELECT * FROM locales WHERE codUsuario = '$idDueño'";
                    $resulLocales = consultaSql($consulta);
                    $filas = mysqli_num_rows($resulLocales);
                    if($filas == 0){
                      echo "<h1 style='margin: 100px auto; text-align: center;color: var(--blanco); text-decoration: underline;'> 
                        No tienes Locales!";
                      }else{?>
                      <h1>Promociones de tus Locales</h1>
                      <table>
                          <thead>
                           <tr>
                             <th scope="col">CodigoPromocion</th>
                             <th scope="col">Descripcion</th>
                             <th scope="col">Valida hasta</th>
                             <th scope="col" id="ult">Dias que aplica</th>
                             <th scope="col">Eliminar</th>

  
                           </tr>
                         </thead>
                     <?php while($fila = mysqli_fetch_assoc($resulLocales)){
                          $local = $fila['codigoLocal'];
                          $consulta = "SELECT * FROM promociones WHERE codigoLocal = '$local' AND confirmado = 1";
                          $resul = consultaSql($consulta);
                          $cantPromos = mysqli_num_rows($resul);
                          if($cantPromos != 0){
                           ?>
                           <?php 

                           while($promo = mysqli_fetch_assoc($resul)){
                              ?>
                            <tr>
                                <td><?= $promo["codigoPromo"] ?></td>
                                <td><?= $promo["texto"] ?></td>
                                <td><?= $promo["fechaHasta"]?></td>
                                <td><?php $dias = explode(',', $promo['diaSemana']); 
                                                $nombresDias = [
                                                        '0' => 'Domingo',
                                                        '1' => 'Lunes',
                                                        '2' => 'Martes',
                                                        '3' => 'Miércoles',
                                                        '4' => 'Jueves',
                                                        '5' => 'Viernes',
                                                        '6' => 'Sábado'
                                                ];
                                                    $diasTexto = array_map(fn($d) => $nombresDias[$d], $dias);

                                        // los unimos con coma o guion
                                        echo implode(', ', $diasTexto);?></td>
                                        <td> <form action="" method="post">
                                        <input type="hidden" name="idPromo" value="<?php echo $promo['codigoPromo']; ?>">
                                        <button type="submit" name="eliminar">❌</button>
                                    </form></td>
                            </tr>   
                                
                             <?php }?>

                                <?php }}?>
                                        <?php 
                                        if(isset($_POST['eliminar'])){
                                            $codPromo = $_POST['idPromo'];
                                            $fechaUso = date('Y/m/d');
                                            $consulta = "DELETE FROM promociones WHERE codigoPromo = '$codPromo'";
                                            $resConsulta = consultaSql($consulta);
                                            header("Location: promociones.php");
                                            exit();
                                        }
                                        ?>
                              </table>
                              <a href="crearPromocion.php" id="crearPromocion">Crear promocion</a>
                 <?php }}
                    else{
                  $consulta = "SELECT * FROM promociones";
                  $resConsulta = consultaSql($consulta);
                  $cantPromos = mysqli_num_rows($resConsulta);
                  if($cantPromos == 0){
                    echo "<h1> NO hay promociones ! </h1>";
                  }
                  else{
                    ?>
                        <h1>Promociones</h1>
                        <table>
                            <thead>
                             <tr>
                               <th scope="col">CodigoPromocion</th>
                               <th scope="col">Descripcion</th>
                               <th scope="col">Valida hasta</th>
                               <th scope="col" id="ult">Dias que aplica</th>
                             </tr>
                           </thead>
                           <?php 
                           while($promocion = mysqli_fetch_assoc($resConsulta)){
                             ?>
                                  <tr>
                                    <td><?= $promocion["codigoPromo"] ?></td>
                                    <td><?= $promocion["texto"] ?></td>
                                    <td><?= $promocion["fechaHasta"]?></td>
                                    <td><?php $dias = explode(',', $promocion['diaSemana']); 
                                                    $nombresDias = [
                                                            '0' => 'Domingo',
                                                            '1' => 'Lunes',
                                                            '2' => 'Martes',
                                                            '3' => 'Miércoles',
                                                            '4' => 'Jueves',
                                                            '5' => 'Viernes',
                                                            '6' => 'Sábado'
                                                    ];
                                                        $diasTexto = array_map(fn($d) => $nombresDias[$d], $dias);
    
                                            // los unimos con coma o guion
                                            echo implode(', ', $diasTexto);?></td>
                                  </tr>
                             <?php }?>
                        </table>                                

                  <?php }
             }
            
            }else{
              echo "<h1> Registrate para ver todas las promociones Disponibles! </h1>";
            }?>
    </div>
    
  </main>
  <footer>
    <div class="container-footer">
      <div class="footer-section contacto">
        <p>Realiza la consulta que quieras <a href="contacto.php">AQUÍ</a></p>

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