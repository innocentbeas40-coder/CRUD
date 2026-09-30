<?php
function eliminar_usuario()
{
    require '../../db/conexion.php';

    $id = $_GET['id'];

    $query = "DELETE FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($conex, $query);

    return $resultado;
}

$resultado = eliminar_usuario();

$message = $resultado ? 1 : 2;

header("Location: ../../pag/users.php?mensaje=$message");
exit;