<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Styles/StylesRegistro.css">
        <title>Regístrate</title>
    </head>
    <body>
        <header>
            <a href="inicio.php"><img src="../assets/oh.png" alt="Boton Home"></a>
            <h2>ONIX CENTER</h2>
        </header>
        <main>
            <h2>¡ Bienvenido ! Regístrate aquí</h2>
            <div class="register-container">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" name="email" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="clave">Clave: </label>
                        <input type="password" name="clave" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo usuario:  </label>
                        <select name="tipoUsuario" required>
                            <option value="Cliente">Cliente</option>
                            <option value="Dueño">Dueño</option>
                        </select>
                        
                    </div>
                    <button type="submit">Registrarse</button>
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
    session_start();
    include "consultaSql.php";
    if (!empty($_POST['email']) && !empty($_POST['clave']) && !empty($_POST['tipoUsuario'])){
        $email = $_POST['email']; 
        $clave = $_POST['clave'];
        $tipoUsuario = $_POST['tipoUsuario'];
        $consultaSiYaEsta = "SELECT * FROM usuarios WHERE nombreUsuario = '$email'";
        $resultadoConsultaSiEsta = consultaSql($consultaSiYaEsta);
        $numeroDeVecesQueEsta = mysqli_num_rows($resultadoConsultaSiEsta);
        if($numeroDeVecesQueEsta){
            echo "<h3 class = 'error-message'> Ya existe ese mail registrado. Intenta de nuevo </h3>";
        }
        else{
            if($tipoUsuario == "Cliente"){
                $token = bin2hex(random_bytes(16)); // genero un código aleatorio (token) único

                $consultaAltaCliente = "INSERT INTO usuarios (nombreUsuario, claveUsuario, tipoUsuario, categoriaCliente, token, confirmado) 
                VALUES ('$email', '$clave', '$tipoUsuario', 'Inicial', '$token', 0)";
                $resultadoConsultaAlta = consultaSql($consultaAltaCliente);
                try {
                    // Configuración del servidor SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'onixcenter04@gmail.com'; 
                    $mail->Password =  'yszl gmvy tppz nron'; //contraseña generada de aplicación
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Remitente
                    $mail->setFrom('onixcenter04@gmail.com', 'Supermercado Onix');

                    // Destinatario
                    $mail->addAddress($email);

                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = 'Confirma tu cuenta en Supermercado Onix';
                    $mail->Body = "
                        <h2>Bienvenido a Supermercado Onix</h2>
                        <p>Gracias por registrarte. Haz clic en el siguiente enlace para confirmar tu cuenta:</p>
                        <a href='http://127.0.0.1/TP_Final_Entornos/TpFinal/src/verificar.php?token=$token'>Confirmar cuenta</a>
                        <p>Si no te registraste, ignora este mensaje.</p> ";
                    // Enviar correo
                    $mail->send();
                    echo "<h3 class='success-message' style='color: white; text-align: center; margin-top: 20px; font-weight: bold;
                    text-decoration: underline;'>Registro exitoso. Revisa tu correo para confirmar tu cuenta.</h3>";

                } catch (Exception $e) {
                    echo "<h3 class='error-message'>No se pudo enviar el correo. Error: {$mail->ErrorInfo}</h3>";
                }
            }
            else {
            $token = bin2hex(random_bytes(16));

            $consultaAltaDueño = "INSERT INTO usuarios (nombreUsuario, claveUsuario, tipoUsuario, token, confirmado) 
            VALUES ('$email', '$clave', '$tipoUsuario', '$token', 0)";
            $resultadoConsultaAlta = consultaSql( $consultaAltaDueño);
                try {
                    // Configuración del servidor SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'onixcenter04@gmail.com'; 
                    $mail->Password =  'yszl gmvy tppz nron'; //contraseña generada de aplicación
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Remitente
                    $mail->setFrom('onixcenter04@gmail.com', 'Supermercado Onix');

                    // Destinatario
                    $mail->addAddress($email);

                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = 'Nuevo dueno de Local: ' . $email;
                    $mail->Body = "
                        <h2>Aceptas al dueño? </h2>
                        <p>Haz clic en el siguiente enlace para confirmar: </p>
                        <a href='http://127.0.0.1/TP_Final_Entornos/TpFinal/src/verificar.php?token=$token'>Confirmar cuenta</a>";
                    // Enviar correo
                    $mail->send();
                    echo "<h3 class='success-message' style='color: white; text-align: center; margin-top: 20px; font-weight: bold;
                    text-decoration: underline;'>Registro exitoso. Espera a que el administrador te acepte.</h3>";

                } catch (Exception $e) {
                    echo "<h3 class='error-message'>No se pudo enviar el correo. Error: {$mail->ErrorInfo}</h3>";
                }
            }


        }
    }
    ?>
</body>
</html>