<?php
// Inicializar el array de 100 elementos con valores "M" o "F"
$array = [];
for ($i = 0; $i < 100; $i++) {
    // Asignar "M" o "F" de manera aleatoria
    $array[] = rand(0, 1) == 0 ? 'M' : 'F';
}

// Inicializar el array asociativo para contar los valores
$conteo = ['M' => 0, 'F' => 0];

// Recorrer el array y contar los valores
foreach ($array as $valor) {
    $conteo[$valor]++;
}

// Mostrar el resultado
echo "Conteo de 'M': " . $conteo['M'] . "\n";
echo "Conteo de 'F': " . $conteo['F'] . "\n";
?>
