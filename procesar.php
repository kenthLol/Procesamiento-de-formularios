<?php
function procesar($alumno)
{
    if (file_exists('archivoAlumnos')) {
        $alumnos = unserialize(file_get_contents('archivoAlumnos'));
    } else {
        $alumnos = array();
    }

    //Agregar el nuevo objeto Alumno al array de alumnos
    array_push($alumnos, $alumno);

    //Serializar el array de alumnos y guardar en el archivo archivoAlumnos
    file_put_contents('archivoAlumnos', serialize($alumnos));
}
?>