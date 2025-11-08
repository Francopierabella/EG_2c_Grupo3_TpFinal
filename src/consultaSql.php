<?php

function consultaSql($consulta): bool|mysqli_result {
    $conn = mysqli_connect(
        getenv('DB_HOST'),
        getenv('DB_USER'),
        getenv('DB_PASS'),
        getenv('DB_NAME'),
        getenv('DB_PORT')
    );

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $resultadoConsulta = mysqli_query($conn, $consulta);
    mysqli_close($conn);

    return $resultadoConsulta;
}