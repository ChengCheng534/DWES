<?php
// Comprobar si el usuario seleccionó un idioma
if (isset($_GET['lang'])) {
    $idioma = $_GET['lang'];
    setcookie("idioma", $idioma, time() + (86400 * 30), "/"); // Cookie válida por 30 días
} elseif (isset($_COOKIE["idioma"])) {
    $idioma = $_COOKIE["idioma"];
} else {
    $idioma = "es"; // Idioma por defecto
}

// Definir los textos en diferentes idiomas
$textos = [
    "es" => [
        "saludo" => "Hola, bienvenido a nuestra página!",
        "selecciona" => "Selecciona tu idioma:",
        "subpagina" => "Ir a la subpágina",
        "volver" => "Volver a la página principal"
    ],
    "en" => [
        "saludo" => "Hello, welcome to our page!",
        "selecciona" => "Select your language:",
        "subpagina" => "Go to the subpage",
        "volver" => "Back to the main page"
    ]
];
?>
