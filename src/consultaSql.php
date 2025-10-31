<?php

function consultaSql($consulta){
    $conexion = mysqli_connect("localhost","root","","onixcenter");
    $resultadoConsulta = mysqli_query($conexion,$consulta);
    mysqli_close($conexion);
    return $resultadoConsulta;
}

?>