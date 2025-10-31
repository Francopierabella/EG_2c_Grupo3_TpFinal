<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta verificada</title>
</head>
<body>

    <?php
    include "consultaSql.php";
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $consulta = "UPDATE usuarios SET confirmado = 1 WHERE token = '$token'";    
        $res = consultaSql($consulta);
        if ($res) {
            echo "<h3 style='text-align: center;'>Cuenta verificada correctamente. Ya puedes iniciar sesión.</h3>";
        } else {
            echo "<h3 style='text-align: center;'>Error al verificar la cuenta. Intenta de nuevo más tarde.</h3>";
        }
        echo "<a href='login.php'>Ir a Login</a>";

    }
    ?>
    <style>
        *{
            font-family: sans-serif;
            font-weight: bold;
        }
        a{
            display: flex;
            text-align: center;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
            font-weight: bold;
            width: 100px;
            text-decoration: underline;
            border: 2px solid blue; 
            border-radius: 10px;
            padding: 10px;
            background-color: #f0f8ff;
            color: black;
        }
        a:hover{
            background-color: #bdd8f0ff;
            transform: scale(1.05) ;
        }
    </style>
</body>
</html>
