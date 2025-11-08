<?php

function consultaSql($consulta): bool|mysqli_result {
    $conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "onixcenter"
    );

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $resultadoConsulta = mysqli_query($conn, $consulta);
    mysqli_close($conn);

    return $resultadoConsulta;
}