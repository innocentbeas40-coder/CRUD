<?php
session_start();

require '../includes/iniciar_seccion.php';

$errores = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = iniciar_seccion();

    if (!$errores) {
        header('Location: pag/dashboard.php');
        exit;
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css" />

    <title>Ejemplo de conexión DB</title>
</head>

<body>


    <form method="post">


        <?php
        if ($errores) {
            foreach ($errores as $error) {
                echo "<p>$error</p>";
            }
        }
        ?>

        <fieldset>
            <h3>inicia sección </h3>

            <div class="contenedor_campos">

                <div class="campos">
                    <input type="string" name="documento" placeholder="Documento">
                </div>

                <div class="campos">
                    <input type="password" name="contraseña" placeholder="Contraseña">
                </div>

            </div>

            <div class=" contenedor_boton">
                <input class="boton" type="submit" value="enviar" />
            </div>

        </fieldset>

        </div>






    </form>

</body>

</html>