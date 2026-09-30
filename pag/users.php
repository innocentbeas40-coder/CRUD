<?php

// require '../db/proteger.php';
header("Cache-Control: no-store");
require '../includes/obtener_usuario.php';

$usuarios = obtener_usuarios();

$message = isset($_GET['mensaje']) ? 1 : 2;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css" />
    <title>Document</title>
</head>

<body>
    <h1>conexión con MySqli</h1>

    <table border="2">
        <div class="contenedorB">
            <a class="boton" href="../form/FormUsuarios.php">Crear Usuario</a>
        </div>
        <thead>


            <tr>
                <th colspan="3">Nombres</th>
                <th colspan="3">Segundo Nombre</th>
                <th colspan="3">Documento</th>

                <th colspan="3">email</th>
                <th colspan="3">teléfono</th>
                <th colspan="3">opciones</th>
            </tr>
        </thead>


        <tbody>
            <?php

            while ($user = mysqli_fetch_assoc($usuarios)) {

            ?>

                <tr>

                    <td colspan="3"><?php echo $user['nombre'] ?></td>
                    <td colspan="3"><?php echo $user['segundo_nombre'] ?></td>
                    <td colspan="3"><?php echo $user['documento'] ?></td>
                    <td colspan="3"><?php echo $user['email'] ?></td>
                    <td colspan="3"><?php echo $user['telefono'] ?></td>
                    <td><a class="boton" href="../includes/users/update.php?id=<?php echo $user['id']; ?>">actualizar</a></td>
                    <td><a class="boton" href="../includes/users/delete.php?id=<?php echo $user['id']; ?>" onclick="return confirm('¿Está seguro de que desea eliminar este usuario?');">eliminar</a></td>



                </tr>

            <?php
            }

            ?>


        </tbody>
    </table>

    <div class="contenedorB">

        <a class="boton" href="../pag/CerrarSesion.php">Cerrar Sesión</a>
    </div>

</body>

</html>