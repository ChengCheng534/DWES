<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function test_rutas_locales($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

function comprobarDatos($datos)
{
    if (!isset($datos)) return false;
    if (empty($datos)) return false;

    return true;
}

function comprobarDatosNoRequeridos($datos)
{
    if (!isset($datos)) return false;
    return true;
}

function comprobarNumero($num)
{
    if (!isset($num)) return false;
    if (empty($num)) return false;
    if (is_numeric($num)) return true;
}

function comprobarNumeroNoRequerido($num)
{
    if (!isset($num)) return false;
    if (!empty($num)) {
        if (is_numeric($num)) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

// Validar matrícula con expresión regular
function validarFormatoMatricula($matricula)
{
    if (!preg_match("/^[0-9]{4}[A-Z]{3}$/", $matricula)) {
        return false;
    }

    return true;
}
function validarRutaImagen($ruta)
{
    // Asegurarse de que la ruta contiene solo caracteres permitidos
    $patron = "/^[a-zA-Z0-9\/\-_\.\\\:\%\ ]+$/";
    if (!preg_match($patron, $ruta)) {
        return false;
    }

    // Comprobar que el archivo tiene una extensión de imagen válida
    $extensionesPermitidas = array("jpg", "jpeg", "png", "webp", "gif");
    $posicionPunto = strrpos($ruta, '.');
    if ($posicionPunto === false) {
        return false;
    }
    $extension = substr($ruta, $posicionPunto + 1);
    if (!in_array(strtolower($extension), $extensionesPermitidas)) {
        return false;
    }

    return true;
}

function formularioErrores(...$error)
{

    foreach ($error as $value) {
        if (strlen($value) > 0) {
            return false;
        }
    }
    return true;
}

// Función para registrar errores en el archivo log/error.log 
function registrarError($criticidad, $mensaje)
{
    $fechaHora = new DateTime("now", new DateTimeZone("Europe/Madrid"));
    $fechaHoraStr = $fechaHora->format("d-m-Y H:i:s");
    $logMensaje = $fechaHoraStr . " - " . $criticidad . " - " . $mensaje . "\n";
    error_log($logMensaje, 3, "log/error.log");
}
