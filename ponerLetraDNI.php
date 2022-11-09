<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTD-8">
        <title>DNI</title>
    </head>

    <body>
        <form method="post">
            Nombre: <input type="text" name="nombre" required><br>
            Número de DNI: <input type="number" min="0" max="99999999" name="numberOfDNI" required><br>
            <input type="submit" name="ok" value="Enviar">

        </form>

        <?php
            if (isset($_REQUEST['ok'])){
                $host='localhost';
                $usuario='root';
                $contraseña='';
                $bd='t3';
            
                $conexion=mysqli_connect($host,$usuario,$contraseña,$bd)
                    or die('Problemas con la conexión');

                $restoDNI = $_REQUEST['numberOfDNI'] % 23;

                $datos=mysqli_query($conexion,"select letra from letradni
                                where resto=$restoDNI")
                                or die('Problemas al seleccionar: '.mysqli_error($conexion));

                if($fila=mysqli_fetch_array($datos)){
                    $dni = $_REQUEST['numberOfDNI'].$fila['letra'];

                    $insert = mysqli_query($conexion,"insert into dnis(nombre,dni)
                            values ('$_REQUEST[nombre]','$dni')")
                            or die('Problemas al insertar: '.mysqli_error($conexion));

                    if ($insert){
                        echo "Nombre y usuario gurdados con éxito en la base de datos";
                    } else {
                        "No se ha podido guardar";
                    }
                }

                mysqli_close($conexion);
                
                
            }






        ?>
    </body>
</html>