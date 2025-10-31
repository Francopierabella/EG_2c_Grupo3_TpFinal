<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/StylesLogin.css?v=1.0">
    <title>Iniciar Sesion</title>
</head>
<body>
    <header>
        <a href="inicio.php"><img src="../assets/oh.png" alt=""></a>
        <h2>ONIX CENTER</h2>
    </header>

    <main>
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </main>
    <?php 
    session_start();
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conexion = mysqli_connect("Localhost", "root", "", "onixcenter");
        $consulta = "SELECT * FROM usuarios WHERE nombreUsuario = '$username' AND claveUsuario = '$password'";
        $resultado = mysqli_query($conexion, $consulta);
        $filas = mysqli_num_rows($resultado);
        if($filas){
            $_SESSION['usuario'] = $username;
            header("location: inicio.php");
        } else {
            ?>
            <h3 class="error-message">Error en la autenticación. Por favor, verifique sus credenciales.</h3>
            <?php
        }
    }     
    ?>
</body>
</html>