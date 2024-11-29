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
    $materias = array_keys($calificaciones['Cesar']);

    // Iteramos sobre cada materia
    foreach ($materias as $materia) {
        $suma = 0;
        $cantidad = 0;

        // Iteramos sobre cada estudiante para obtener su calificación en la materia actual
        foreach ($calificaciones as $estudiante => $notasEstudiante) {
            $suma += $notasEstudiante[$materia];
            $cantidad++;
        }

        // Calculamos el promedio
        $promedios[$materia] = $suma / $cantidad;
    }

    return $promedios;
}

function promedioPorEstudiante($calificaciones) {
    $promedios = [];

    foreach ($calificaciones as $alumno => $notasEstudiante) {
        $suma = array_sum($notasEstudiante);
        $numMaterias = count($notasEstudiante);


        $promedios[$alumno] = $suma/$numMaterias;
    }

    //$redondear = number_format($promedios, 2);
    return $promedios;
}

function mejorEstudiantePorMateria($calificaciones){
    $materias = array_keys($calificaciones['Cesar']);
    $alumno = [];

    foreach ($materias as $materia) {
        $mejorEstudiante = 0;
        $mejorNota = -1;

        foreach ($calificaciones as $estudiante => $notasEstudiante) {
            if ($notasEstudiante[$materia] > $mejorNota) {
                $mejorNota = $notasEstudiante[$materia];
                $mejorEstudiante = $estudiante;
            }
        }
        $alumno[$materia] = $mejorEstudiante;
        print_r($alumno);
    }
    return;
}


echo "Promedio por materia:\n";
print_r(promedioPorMateria($calificaciones));


echo "Promedio de alumno:\n";
print_r(promedioPorEstudiante($calificaciones));

echo "Mejor alumno de cada Materia:\n";
print_r(mejorEstudiantePorMateria($calificaciones));

?>
