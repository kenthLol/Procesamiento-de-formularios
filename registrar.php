<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Listar</title>
</head>

<body>
    <?php
    // Incluir la clase Alumno y procesar
    include "alumno.php";
    include "procesar.php";

    // Obtener los datos del alumno desde el formulario
    $correo = $_POST['email'];
    $nombre = $_POST['nombre'];
    $carnet = $_POST['carnet'];
    $edad = $_POST['edad'];
    $curso = $_POST['curso'];
    $foto = $_FILES['foto'];

    $fecha_actual = date('Y-m-d');

    // Concatenar el nombre de usuario y la fecha actual, separados por un guion bajo
    $nuevo_nombre_archivo = $nombre . '_' . $fecha_actual . '.jpg';
    $foto['name'] = $nuevo_nombre_archivo;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $archivo_temporal = $_FILES['foto']['tmp_name'];
        $ubicacion_archivo = 'images/' . $nuevo_nombre_archivo;
        $foto['full_path'] = $ubicacion_archivo;
        if (move_uploaded_file($archivo_temporal, $ubicacion_archivo)) {
            $message = "El archivo se ha guardado correctamente en " . $ubicacion_archivo;
            error_log($message, 0);
        } else {
            error_log("Error al cargar el archivo", 1);
        }
    }

    // Subir la imagen del alumno al servidor
    // $nombreDirectorio = "img/";
    // $idUnico = time();
    // $nombreFichero = $idUnico . "-" . $foto['name'];
    // move_uploaded_file($foto['tmp_name'], $nombreDirectorio . $nombreFichero);
    

    // Crear un nuevo objeto Alumno con los datos ingresados
    $alumno = new Alumno($correo, $nombre, $carnet, $edad, $curso, $foto);

    procesar($alumno);

    echo '<div class="my-3" style="padding-left: 15px">';
    echo '    <a href="index.php" class="btn btn-secondary">Regresar a la página principal</a>';
    echo '</div>';

    ?>
    <!-- Agregar los scripts de Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>