<?php
require 'vendor/autoload.php';
require_once('classes/mensaje.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function comprobarEmail($email) {
    return preg_match("/^[^@\s]+@[^@\s]+\.[a-zA-Z]{2,}$/", $email);
}

$mail = new PHPMailer(true);

$destinatario = readline("=> Introduce un destinatario: ");
while (!comprobarEmail($destinatario)) {
    echo "---Correo no válido. Inténtalo nuevamente.\n";
    $destinatario = readline("Introduce nuevo destinatario: ");
}
$asunto = readline("=> Introduce un asunto: ");
$contMensj = readline("=> Introduce un mensaje: ");

$mensaje = new Mensaje($destinatario,$asunto,$contMensj);

$option = null;
while ($option != 7) {
    echo "\n";
    echo "·DESTINATARIO: " . implode(", ", $mensaje->destinatario) . "\n";
    echo "·ASUNTO: " .  $mensaje->asunto . "\n";
    echo "·MENSAJE: \n" . $mensaje->cuerpo . "\n";

    if (!empty($mensaje->cc) || $mensaje->cc != null) {
        echo "CC: " . implode(", ", $mensaje->cc) . "\n";
    }

    if (!empty($mensaje->cco) || $mensaje->cco != null) {
        echo "CCO: " . implode(", ", $mensaje->cco) . "\n";
    }

    if (!empty($mensaje->adjuntos) || $mensaje->adjuntos != null) {
        echo "Adjuntos: " . implode(", ", $mensaje->adjuntos) . "\n";
    }

    $menu = <<<'MENU'
    Elige la operación que quiere hacer:
    -----------------------------------------
    1) Gestionar destinatarios.
    2) Cambiar asunto.
    3) Cambiar mensaje.
    4) Gestionar CC.
    5) Gestionar CCO.
    6) Gestionar adjuntos.
    7) Enviar mensaje.
    MENU;

    echo "\n".$menu."\n\n";

    $option = readline("=> Opción: ");

    switch ($option) {
        case 1:
            $subOption = null;
            while ($subOption != 3) {
                $menuDesti = <<<'MENU'
                Gestionar destinatarios:
                ------------------------------------
                1) Añadir destinatario.
                2) Quitar destinatario.
                3) Volver al menú principal.
                MENU;

                echo "\n".$menuDesti."\n\n";

                $subOption = readline("=> Opción: ");
                switch ($subOption) {
                    case 1:
                        $nuevoDestinatario = readline("=> Introduce nuevo destinatario: ");

                        while (!comprobarEmail($nuevoDestinatario)) {
                            echo "---Correo no válido. Inténtalo nuevamente.\n";
                            $nuevoDestinatario = readline("=> Introduce nuevo destinatario: ");
                        }
                        $mensaje->addDestinatario($nuevoDestinatario);

                        echo "---El destinatario ".$nuevoDestinatario." ha sido añadido correctamente....\n";
                        break;
                    case 2:
                        echo "Lista de destinatario:\n";

                        foreach ($mensaje->destinatario as $index => $email) {
                            echo ($index + 1) . ") " . $email . "\n\n";
                        }
                        $indexToRemove = (int)readline("=> Seleccione el destinatario a quitar: ") - 1;
                        $mensaje->removeDestinatarioByIndex($indexToRemove);

                        echo "---El destinatario ha sido eliminado correctamente....\n";
                        break;
                    case 3:
                        echo "---Volviendo al menú principal...\n";
                        break;
                    default:
                        echo "---Opción no válida.\n";
                }
            }
            break;
        case 2:
            $mensaje->asunto = readline("Introduce nuevo asunto: ");
            echo "---El asunto ha sido modificado correctamente....\n";
            break;
        case 3:
            $añadirMensj = null;
            $mensaje->cuerpo = "";
            do {
                $añadirMensj = readLine("=> Introduce una nueva linea (para salir de la consola escribe :salirConsola): ");
                if ($mensaje != ":salirConsola") {
                    $mensaje->cuerpo .= $añadirMensj . "\n";
                }
            }
            while($añadirMensj != ":salirConsola");
            echo "---El mensaje ha sido modificado correctamente....\n";
            break;
        case 4:
            $subOption = null;
            while ($subOption != 3) {
                $menuCC = <<<'MENU'
                Gestionar CC:
                ------------------------------------
                1) Añadir CC.
                2) Quitar CC.
                3) Volver al menú principal.
                MENU;

                echo "\n".$menuCC."\n\n";

                $subOption = readline("=> Opción: ");
                switch ($subOption) {
                    case 1:
                        $nuevoCC = readline("=> Introduce nuevo CC: ");
                        while (!comprobarEmail($nuevoCC)) {
                            echo "---Correo no válido. Inténtalo nuevamente.\n";
                            $nuevoCC = readline("=> Introduce nuevo CC: ");
                        }
                        $mensaje->addCC($nuevoCC);
                        echo "---El CC ".$nuevoCC." ha sido añadido correctamente....\n";
                        break;
                    case 2:
                        echo "Listas de CC:\n";
                        foreach ($mensaje->cc as $index => $email) {
                            echo ($index + 1) . ") " . $email . "\n";
                        }
                        $indexToRemove = (int)readline("=> Seleccione el CC a quitar: ") - 1;
                        $mensaje->removeCCByIndex($indexToRemove);
                        echo "---El CC ha sido eliminado correctamente....\n";
                        break;
                    case 3:
                        echo "---Volviendo al menú principal...\n";
                        break;
                    default:
                        echo "---Opción no válida.\n";
                }
            }
            break;
        case 5:
            $subOption = null;
            while ($subOption != 3) {
                $menuCCO = <<<'MENU'
                Gestionar CCO:
                ------------------------------------
                1) Añadir CCO.
                2) Quitar CCO.
                3) Volver al menú principal.
                MENU;

                echo "\n".$menuCCO."\n\n";

                $subOption = readline("=> Opción: ");
                switch ($subOption) {
                    case 1:
                        $nuevoCCO = readline("=> Introduce nuevo CCO: ");
                        while (!comprobarEmail($nuevoCCO)) {
                            echo "---Correo no válido. Inténtalo nuevamente.\n";
                            $nuevoCCO = readline("=> Introduce nuevo CCO: ");
                        }
                        $mensaje->addCCO($nuevoCCO);
                        echo "---El CCO ".$nuevoCCO." ha sido añadido correctamente....\n";
                        break;
                    case 2:
                        echo "Listas de CCO:\n";
                        foreach ($mensaje->cco as $index => $email) {
                            echo ($index + 1) . ") " . $email . "\n";
                        }
                        $indexToRemove = (int)readline("=> Seleccione el CCO a quitar: ") - 1;
                        $mensaje->removeCCOByIndex($indexToRemove);
                        echo "---El CCO ha sido eliminado correctamente....\n";
                     break;
                    case 3:
                        echo "---Volviendo al menú principal...\n";
                        break;
                    default:
                        echo "---Opción no válida.\n";
                }
            }
            break;
        case 6:
            $subOption = null;
            while ($subOption != 3) {
                $menuAdj = <<<'MENU'
                Gestionar Adjuntos:
                ------------------------------------
                1) Añadir adjunto.
                2) Quitar adjunto.
                3) Volver al menú principal.
                MENU;

                echo "\n".$menuAdj."\n\n";
                
                $subOption = readline("=> Opción: ");
                switch ($subOption) {
                    case 1:
                        $dir = 'mensaje/';

                        if (is_dir($dir)) {
                            $index = 1;
                            $files = scandir($dir); 
                            $archivosDisponibles = [];
        
                            echo "Listas de adjuntos:\n";
                            foreach ($files as $file) {
                                if ($file != '.' && $file != '..') {
                                    echo ($index) . ") " . $file . "\n\n"; 
                                    $archivosDisponibles[$index - 1] = $file; 
                                    $index++;
                                }
                            }
        
                            if (count($archivosDisponibles) > 0) {
                                $seleccion = (int)readline("=> Selecciona el número del archivo a añadir como adjunto: ");
        
                                if (isset($archivosDisponibles[$seleccion - 1])) {
                                    $archivoSeleccionado = $archivosDisponibles[$seleccion - 1];
                                    $rutaArchivo = $dir . $archivoSeleccionado;
        
                                    $mensaje->addAdjunto($rutaArchivo);
                                    echo "Adjunto añadido: " . $archivoSeleccionado . "\n";
                                } else {
                                    echo "---Selección no válida.\n";
                                }
                            } else {
                                echo "---No hay archivos disponibles en el directorio.\n";
                            }
                        } else {
                            echo "---El directorio no existe.\n";
                        }
                        break;
                    case 2:
                        echo "Listas de adjuntos:\n";
                        foreach ($mensaje->adjuntos as $index => $file) {
                            echo ($index + 1) . ") " . $file . "\n";
                        }
                        $indexToRemove = (int)readline("Seleccione el adjunto a quitar: ") - 1;
                        $mensaje->removeAdjuntoByIndex($indexToRemove);
                        echo "---El adjunto ha sido añadido correctamente....\n";
                        break;
                    case 3:
                        echo "---Volviendo al menú principal...\n";
                        break;
                    default:
                        echo "---Opción no válida.\n";
                }
            }
        break;
            case 7:
                try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'yushen740@gmail.com';
                    $mail->Password = 'wabx vbpu zfzy afhz';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;

                    $mail->setFrom('yushen740@gmail.com', 'Mailer');
                    
                    foreach ($mensaje->destinatario as $dest) {
                        $mail->addAddress($dest);
                    }
                    foreach ($mensaje->cc as $cc) {
                        $mail->addCC($cc);
                    }
                    foreach ($mensaje->cco as $cco) {
                        $mail->addBCC($cco);
                    }
                    foreach ($mensaje->adjuntos as $adjunto) {
                        $mail->addAttachment($adjunto);
                    }
            
                    $mail->isHTML(true);
                    $mail->Subject = $mensaje->asunto;
                    $mail->Body = nl2br($mensaje->cuerpo);
            
                    $mail->send();
                    echo $mensaje."\n";
                    echo "---Mensaje enviado con éxito.\n";
                } catch (Exception $e) {
                    echo "---Error al enviar el mensaje: {$mail->ErrorInfo}\n";
                }
            break;
        default;
            echo "---Opción no válida.\n";
    }
}