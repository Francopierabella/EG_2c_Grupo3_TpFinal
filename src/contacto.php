<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./Styles/StylesContacto.css">
    <title>Document</title>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-md bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="../assets/oh.png" alt=""></a>

      <!-- Botón hamburguesa -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Menú desplegable -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-sm-0 text-center">
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
        <h2>Envia consultas al adminsitrador</h2>
       <div class="contacto-container">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" name="email" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="clave">Asunto: </label>
                        <input type="text" name="asunto" required>
                    </div>
                    <div class="mensaje">
                        <label for="tipo">Mensaje:  </label>
                        <textarea name="mensaje" ></textarea>
                        
                    </div>
                    <button type="submit">Enviar consulta</button>
                </form>
            </div>
</main>
<?php 
use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
    require 'C:\xampp\htdocs\TP_Final_Entornos\TpFinal\vendor\phpmailer\phpmailer\src\Exception.php';
    require 'C:\xampp\htdocs\TP_Final_Entornos\TpFinal\vendor\phpmailer\phpmailer\src\PHPMailer.php';
    require 'C:\xampp\htdocs\TP_Final_Entornos\TpFinal\vendor\phpmailer\phpmailer\src\SMTP.php';

    $mail = new PHPMailer(true);
    include "consultaSql.php";
try {
    
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'onixcenter04@gmail.com'; 
    $mail->Password =  'yszl gmvy tppz nron'; //contraseña generada de aplicación
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    if(!empty($_POST['email']) && !empty($_POST['asunto']) && !empty($_POST['mensaje'])){
        $remitente = $_POST['email'];
        $asunto = $_POST['asunto'];
        $mensaje = $_POST['mensaje'];
        $mail->setFrom('onixcenter04@gmail.com', 'Supermercado Onix');
        $mail->addAddress('onixcenter04@gmail.com'); // El destinatario (admin)
        $mail->addReplyTo($remitente, 'Usuario de OnixCenter'); // <-- Esto hace la magia
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        // Enviar correo
        $mail->send();
        echo "<h3 class='success-message' style='color: white; text-align: center; margin-top: 20px; font-weight: bold;
        text-decoration: underline;'>Consulta Enviada al administrador!</h3>";
    }

} catch (Exception $e) {
    echo "<h3 class='error-message'>No se pudo enviar el correo. Error: {$mail->ErrorInfo}</h3>";
}
        
    
?>
    
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>