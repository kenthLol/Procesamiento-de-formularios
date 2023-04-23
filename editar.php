<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Editar</title>
</head>

<body>
    <?php
    include "alumno.php";
    $contenido = file_get_contents('archivoAlumnos');
    $alumnos = unserialize($contenido);
    $carnet = $_GET['carnet'];
    $alumno = null;

    foreach ($alumnos as $a) {
        if ($a->carnet == $carnet) {
            $alumno = $a;
            break;
        }
    }
    if ($alumno == null) {
        // Si no se encontró el alumno, mostrar un mensaje de error y volver a la página de listado.
        echo "No se encontró el alumno que se desea editar.";
        exit;
    }
    ?>
    <div style="padding-left: 32px">
        <h1>Editar</h1>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 80rem">
            <div class="card-body">
                <div class="container">
                    <h1>Alumnos</h1>
                    <p>Actualice los datos del estudiante: </p>
                    <form action="actualizar.php" method="POST" ENCTYPE="multipart/form-data">
                        <div class="form-group col-12 col-md-6">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" class="form-control" id="email" name="correo"
                                value="<?php echo $alumno->correo; ?>" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="nombre">Nombre completo:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?php echo $alumno->nombre; ?>" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="carnet">Número de carnet:</label>
                            <input type="text" class="form-control" id="carnet" name="carnet"
                                value="<?php echo $alumno->carnet; ?>" readonly>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="edad">Edad:</label>
                            <input type="number" class="form-control" id="edad" name="edad"
                                value="<?php echo $alumno->edad; ?>" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="curso">Curso actual:</label>
                            <input type="text" class="form-control" id="curso" name="curso"
                                value="<?php echo $alumno->curso; ?>" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="foto">Foto:</label>
                            <div class="photo-preview">
                                <img id="photo-preview" src="<?php echo $alumno->foto['full_path']; ?>"
                                    alt="Foto de <?php echo $alumno->nombre; ?>">
                            </div>
                            <input type="file" class="form-control-file" id="foto" name="foto"
                                onchange="previewPhoto()">
                        </div>
                        <div style="padding-left: 15px;">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="my-3" style="padding-left: 35px">
        <a href="index.php" class="btn btn-secondary">Regresar a la página principal</a>
    </div>

    <script>
        function previewPhoto() {
            const photoInput = document.getElementById("foto");
            const photoPreview = document.getElementById("photo-preview");
            const file = photoInput.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                photoPreview.setAttribute("src", e.target.result);
            }
            reader.readAsDataURL(file);
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>