<?php
// Array de calificaciones de los estudiantes
$calificaciones = [
    'Cesar' => ['DWES' => 8, 'DWEC' => 9, 'DAW' => 7],
    'Javier' => ['DWES' => 6, 'DWEC' => 5, 'DAW' => 6],
    'Hugo' => ['DWES' => 7, 'DWEC' => 6, 'DAW' => 8],
    'Cheng' => ['DWES' => 9, 'DWEC' => 9, 'DAW' => 9]
];

// 1. Función promedioPorMateria
function promedioPorMateria($calificaciones) {
    $promedios = [];
    $materias = array_keys($calificaciones['Cesar']); // Asumimos que todas las materias están en todos los estudiantes

    // Iteramos sobre cada materia
    foreach ($materias as $materia) {
        $suma = 0;
        $cantidad = 0;

        // Iteramos sobre cada estudiante para obtener su calificación en la materia actual
        foreach ($calificaciones as $estudiante => $materias_estudiante) {
            $suma += $materias_estudiante[$materia];
            $cantidad++;
        }

        // Calculamos el promedio
        $promedios[$materia] = $suma / $cantidad;
    }

    return $promedios;
}

// 2. Función promedioPorEstudiante
function promedioPorEstudiante($calificaciones) {
    $promedios = [];

    // Iteramos sobre cada estudiante
    foreach ($calificaciones as $estudiante => $materias_estudiante) {
        $suma = array_sum($materias_estudiante);
        $cantidad = count($materias_estudiante);
        
        // Calculamos el promedio del estudiante
        $promedios[$estudiante] = $suma / $cantidad;
    }

    return $promedios;
}

// 3. Función mejorEstudiantePorMateria
function mejorEstudiantePorMateria($calificaciones) {
    $mejores = [];
    $materias = array_keys($calificaciones['Cesar']); // Asumimos que todas las materias están en todos los estudiantes

    // Iteramos sobre cada materia
    foreach ($materias as $materia) {
        $mejor_estudiante = '';
        $mejor_calificacion = -1;

        // Iteramos sobre cada estudiante
        foreach ($calificaciones as $estudiante => $materias_estudiante) {
            if ($materias_estudiante[$materia] > $mejor_calificacion) {
                $mejor_calificacion = $materias_estudiante[$materia];
                $mejor_estudiante = $estudiante;
            }
        }

        // Guardamos el mejor estudiante para la materia
        $mejores[$materia] = $mejor_estudiante;
    }

    return $mejores;
}

// Ejemplo de uso:
echo "Promedio por materia:\n";
print_r(promedioPorMateria($calificaciones));

echo "\nPromedio por estudiante:\n";
print_r(promedioPorEstudiante($calificaciones));

echo "\nMejor estudiante por materia:\n";
print_r(mejorEstudiantePorMateria($calificaciones));
?>
