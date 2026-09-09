<?php

require 'db/funciones.php';

if (isset($_POST['guardar'])) {
    $errores = agregar_usuario();

    if ($errores) {
        foreach ($errores as $error) {
            echo "<p>" . $error . "</p>";
        }
    }
}



$usuarios = obtener_usuarios();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
</head>

<body>
    <h1>conexión con MySqli</h1>

    <table border="2">
        <thead>
            <tr>
                <th colspan="3">Nombres</th>
                <th colspan="3">Segundo Nombre</th>
                <th colspan="3">Documento</th>
                <th colspan="3">contraseña</th>
                <th colspan="3">email</th>
                <th colspan="3">teléfono</th>
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
                    <td colspan="3"><?php echo $user['contrasena'] ?></td>
                    <td colspan="3"><?php echo $user['email'] ?></td>
                    <td colspan="3"><?php echo $user['telefono'] ?></td>

                </tr>

            <?php
            }

            ?>

            <!-- <table>

                <tr>
                    <td>
                        <form method="post">

                            <label>Nombre</label>
                            <input type="text" name="nombre">

                            <label>segundo Nombre</label>
                            <input type="text" name="segundo_nombre">

                            <label>Documento</label>
                            <input type="string" name="documento">

                            <label>Contraseña</label>
                            <input type="password" name="contraseña">

                            <label>Confirmar contraseña</label>
                            <input type="input" name="c_contraseña">

                            <label>Email</label>
                            <input type="string" name="email">

                            <label>Teléfono</label>
                            <input type="string" name="telefono">

                            <button type="submit" name="guardar">guardar</button>

                        </form>


                    </td>
                </tr>
            </table> -->

        </tbody>
    </table>





    <form method="post">
        <fieldset>
            <h3>CREA UN usuario</h3>

            <div class="contenedor_campos">

                <div class="campos">
                    <input type="text" name="nombre" placeholder="Nombre">
                </div>

                <div class="campos">
                    <input type="text" name="segundo_nombre" placeholder="Segundo Nombre">
                </div>

                <div class="campos">
                    <input type="string" name="documento" placeholder="Documento">
                </div>

                <div class="campos">
                    <input type="string" name="email" placeholder="Email">
                </div>

                <div class="campos">
                    <input type="string" name="telefono" placeholder="Teléfono">
                </div>

                <div class="campos">
                    <input type="password" name="contraseña" placeholder="Contraseña">
                </div>

                <div class="campos">
                    <input type="input" name="c_contraseña" placeholder="Confirma tu Contraseña">
                </div>

            </div>

            <div class=" contenedor_boton">
                <input class="boton" type="submit" name="guardar" />
            </div>

        </fieldset>

        </div>






    </form>
</body>

</html>