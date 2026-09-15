<?php

// require '../db/proteger.php';

require '../db/funciones.php';

if (isset($_POST['guardar'])) {
    $errores = agregar_usuario();

    if ($errores) {
        foreach ($errores as $error) {
            echo "<p>" . $error . "</p>";
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" />
    <title>Document</title>
</head>

<body>
    
    <form method="post">
        <fieldset>
            <h3>crea un usuario</h3>

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

        <div class=" contenedor_boton">
                <a class="boton" href="../form/FormUsuarios.php">volver atrás</a>
            </div>

        </div>






    </form>
</body>

</html>