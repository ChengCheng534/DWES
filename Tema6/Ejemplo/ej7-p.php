<?php

interface DateFacadeInterface {
    public function obtenerFechaHoraActual();
    public function formatearFecha();
    public function compararFechas($fecha1, $fecha2);
    public function calcularDiferenciaFechas($fecha1, $fecha2);
    public function esFechaValida($dia, $mes, $anio);
    public function modificarFecha($fecha, $modificacion);
    public function convertirZonaHoraria($fecha, $hora, $zonaOrigen, $zonaDestino);
    public function obtenerFechaNMesesAtras($fecha, $meses);
}

class DateFacade implements DateFacadeInterface {

    // 1. Obtener fecha usando date() y strftime()
    public function obtenerFechaHoraActual() {
        // Fecha en formato dd-mm-aaaa
        return date('d-m-Y') . " (usando date())\n" .
               strftime('%d-%m-%Y'); // Usando strftime()
    }

    // 2. Formatear fecha: retorna en formato "Lunes 4 de noviembre del 2024"
    public function formatearFecha() {
        setlocale(LC_TIME, 'es_ES.UTF-8'); // Configura el idioma
        return strftime('%A %d de %B del %Y', time());
    }

    // 3. Comparar fechas: muestra cuál es anterior, posterior o si son iguales
    public function compararFechas($fecha1, $fecha2) {
        $date1 = DateTime::createFromFormat('d-m-Y', $fecha1);
        $date2 = DateTime::createFromFormat('d-m-Y', $fecha2);

        if ($date1 == $date2) {
            return "Las fechas son iguales.";
        } elseif ($date1 < $date2) {
            return "La fecha $fecha1 es anterior a $fecha2.";
        } else {
            return "La fecha $fecha1 es posterior a $fecha2.";
        }
    }

    // 4. Calcular diferencia entre fechas: devuelve la cantidad de días
    public function calcularDiferenciaFechas($fecha1, $fecha2) {
        $date1 = DateTime::createFromFormat('d-m-Y', $fecha1);
        $date2 = DateTime::createFromFormat('d-m-Y', $fecha2);

        if ($date1 && $date2) {
            $diferencia = $date1->diff($date2);
            return "La diferencia es de " . $diferencia->days . " días.";
        } else {
            return "Una o ambas fechas no son válidas.";
        }
    }

    // 5. Validar fechas: verifica si una fecha es correcta
    public function esFechaValida($dia, $mes, $anio) {
        return checkdate($mes, $dia, $anio) 
            ? "La fecha es válida." 
            : "La fecha es inválida.";
    }

    // 6. Modificar fechas: agrega o resta días, semanas, meses, etc.
    public function modificarFecha($fecha, $modificacion) {
        $date = DateTime::createFromFormat('d-m-Y', $fecha);

        if ($date) {
            $date->modify($modificacion);
            return $date->format('d-m-Y');
        } else {
            return "La fecha ingresada no es válida.";
        }
    }

    // 7. Convertir entre zonas horarias: Nueva York a Londres
    public function convertirZonaHoraria($fecha, $hora, $zonaOrigen, $zonaDestino) {
        try {
            $fechaHora = new DateTime("$fecha $hora", new DateTimeZone($zonaOrigen));
            $fechaHora->setTimezone(new DateTimeZone($zonaDestino));
            return $fechaHora->format('d-m-Y H:i:s');
        } catch (Exception $e) {
            return "Error en la conversión de zona horaria: " . $e->getMessage();
        }
    }

    // 8. Generar fechas futuras o pasadas: calcula la fecha N meses atrás
    public function obtenerFechaNMesesAtras($fecha, $meses) {
        $date = DateTime::createFromFormat('d-m-Y', $fecha);

        if ($date) {
            $date->modify("-{$meses} months");
            return $date->format('d-m-Y');
        } else {
            return "La fecha ingresada no es válida.";
        }
    }
}
?>
