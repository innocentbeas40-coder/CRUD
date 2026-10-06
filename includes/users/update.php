<?php

require '../../db/proteger.php';
require __DIR__ . '/../../db/conexion.php';
require '../../db/funciones.php';
require '../../includes/actualizar_usuario.php';


$usuario = actualizar_usuario();

$id = $_GET['id'];

$errores = [];

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../build/css/app.css">

    <title>Actualizar usuario</title>

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

            <h3>Actualiza tu usuario</h3>


            <div class="contenedor_campos">


                <div class="campos">

                    <input
                        type="text"
                        name="nombre"
                        placeholder="Nombre"
                        value="<?php echo $usuario['nombre']; ?>">

                </div>


                <div class="campos">

                    <input
                        type="text"
                        name="segundo_nombre"
                        placeholder="Segundo Nombre"
                        value="<?php echo $usuario['segundo_nombre']; ?>">

                </div>


                <div class="campos">

                    <input
                        type="text"
                        name="documento"
                        placeholder="Documento"
                        value="<?php echo $usuario['documento']; ?>">

                </div>


                <div class="campos">

                    <input
                        type="text"
                        name="email"
                        placeholder="Email"
                        value="<?php echo $usuario['email']; ?>">

                </div>


                <div class="campos">

                    <input
                        type="text"
                        name="telefono"
                        placeholder="Teléfono"
                        value="<?php echo $usuario['telefono']; ?>">

                </div>


                <div class="campos">

                    <input
                        type="password"
                        name="contraseña_antigua"
                        placeholder="Contraseña antigua">

                </div>


                <div class="campos">

                    <input
                        type="password"
                        name="contraseña"
                        placeholder="Nueva contraseña">

                </div>


                <div class="campos">

                    <input
                        type="password"
                        name="c_contraseña"
                        placeholder="Confirmar nueva contraseña">

                </div>


            </div>


            <div class="contenedor_boton">

                <input
                    class="boton"
                    type="submit"
                    name="actualizar"
                    value="Actualizar">

            </div>


        </fieldset>


        <div class="contenedor_boton">

            <a
                class="boton"
                href="../../pag/users.php">
                Volver atrás
            </a>

        </div>


    </form>

</body>

</html>