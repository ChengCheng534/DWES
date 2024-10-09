<?php
// Función para detectar el navegador
function detectar_navegador($user_agent) {
    if (strpos($user_agent, 'Chrome') !== false && strpos($user_agent, 'Edg') === false) {
        return 'Chrome';
    } elseif (strpos($user_agent, 'Firefox') !== false) {
        return 'Firefox';
    } elseif (strpos($user_agent, 'Edg') !== false) {
        return 'Edge';
    } elseif (strpos($user_agent, 'MSIE') !== false || strpos($user_agent, 'Trident') !== false) {
        return 'Internet Explorer';
    } elseif (strpos($user_agent, 'Safari') !== false && strpos($user_agent, 'Chrome') === false) {
        return 'Safari';
    } elseif (strpos($user_agent, 'Opera') !== false || strpos($user_agent, 'OPR') !== false) {
        return 'Opera';
    } else {
        return 'Desconocido';
    }
}

// Obtener el user agent
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Detectar el navegador
$navegador = detectar_navegador($user_agent);

// Configuración de imagen y enlace
$imagen = '';
$enlace = '';

switch ($navegador) {
    case 'Chrome':
        $imagen = 'https://upload.wikimedia.org/wikipedia/commons/8/87/Google_Chrome_icon_%282011%29.png';
        $enlace = 'https://www.google.com/chrome/';
        break;
    case 'Firefox':
        $imagen = 'https://upload.wikimedia.org/wikipedia/commons/e/e7/Mozilla_Firefox_3.5_logo_256.png';
        $enlace = 'https://www.mozilla.org/firefox/';
        break;
    case 'Edge':
        $imagen = 'https://upload.wikimedia.org/wikipedia/commons/9/98/Microsoft_Edge_logo_%282019%29.png';
        $enlace = 'https://www.microsoft.com/edge';
        break;
    case 'Internet Explorer':
        $imagen = 'https://upload.wikimedia.org/wikipedia/commons/4/45/Internet_Explorer_9_icon.png';
        $enlace = 'https://support.microsoft.com/help/17621/internet-explorer-downloads';
        break;
    case 'Safari':
        $imagen = 'https://upload.wikimedia.org/wikipedia/commons/5/52/Safari_browser_logo.png';
        $enlace = 'https://www.apple.com/safari/';
        break;
    case 'Opera':
        $imagen = 'https://upload.wikimedia.org/wikipedia/commons/4/49/Opera_2015_icon.png';
        $enlace = 'https://www.opera.com/';
        break;
    default:
        $imagen = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/450px-No_image_available.svg.png';
        $enlace = '#';
        break;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detección de Navegador</title>
</head>
<body>
    <h1>Navegador Detectado</h1>

    <?php if ($navegador != 'Desconocido') : ?>
        <p>Estás utilizando: <strong><?php echo $navegador; ?></strong></p>
        <a href="<?php echo $enlace; ?>" target="_blank">
            <img src="<?php echo $imagen; ?>" alt="Logo de <?php echo $navegador; ?>" style="width:150px;">
        </a>
        <p><a href="<?php echo $enlace; ?>" target="_blank">Haz clic aquí para descargar <?php echo $navegador; ?></a></p>
    <?php else : ?>
        <p>No hemos podido detectar tu navegador.</p>
    <?php endif; ?>
    
</body>
</html>
