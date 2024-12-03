<?php

interface DateFacadeInterface {
    public function obtenerFechaHoraActual();
    public function formatearFecha($fecha);
    public function compararFechas($fecha1, $fecha2);
    public function calcularDiferenciaFechas($fecha1, $fecha2);
    public function esFechaValida($dia, $mes, $anio);
    public function modificarFecha($fecha, $modificacion);
    public function convertirZonaHoraria($fecha, $zonaOrigen, $zonaDestino);
    public function obtenerFechaNMesesAtras($fecha, $meses);
    public function obtenerPrimerYUltimoDiaDelMes();
}

class DateFacade implements DateFacadeInterface {

    // Devuelve la fecha y hora actual en formato 'Y-m-d H:i:s'
    public function obtenerFechaHoraActual() {
        return date('Y-m-d H:i:s');
    }

    // Recibe una fecha y la devuelve en formato legible 'd/m/Y'
    public function formatearFecha($fecha) {
        $date = new DateTime($fecha);
        return $date->format('d/m/Y');
    }

    // Compara dos fechas, devuelve -1 si $fecha1 < $fecha2, 0 si son iguales, y 1 si $fecha1 > $fecha2
    public function compararFechas($fecha1, $fecha2) {
        $date1 = new DateTime($fecha1);
        $date2 = new DateTime($fecha2);
        return $date1 <=> $date2;
    }

    // Calcula la diferencia en días entre dos fechas
    public function calcularDiferenciaFechas($fecha1, $fecha2) {
        $date1 = new DateTime($fecha1);
        $date2 = new DateTime($fecha2);
        $diferencia = $date1->diff($date2);
        return $diferencia->days; // Devuelve la diferencia en días
    }

    // Verifica si una fecha es válida
    public function esFechaValida($dia, $mes, $anio) {
        return checkdate($mes, $dia, $anio);
    }

    // Modifica una fecha según la modificación indicada (p.ej., '+1 day', '-2 weeks')
    public function modificarFecha($fecha, $modificacion) {
        $date = new DateTime($fecha);
        $date->modify($modificacion);
        return $date->format('Y-m-d');
    }

    // Convierte una fecha de una zona horaria a otra
    public function convertirZonaHoraria($fecha, $zonaOrigen, $zonaDestino) {
        $date = new DateTime($fecha, new DateTimeZone($zonaOrigen));
        $date->setTimezone(new DateTimeZone($zonaDestino));
        return $date->format('Y-m-d H:i:s');
    }

    // Obtiene la fecha de N meses atrás desde una fecha dada
    public function obtenerFechaNMesesAtras($fecha, $meses) {
        $date = new DateTime($fecha);
        $date->modify("-{$meses} months");
        return $date->format('Y-m-d');
    }

    // Devuelve el primer y último día del mes actual
    public function obtenerPrimerYUltimoDiaDelMes() {
        $primerDia = (new DateTime('first day of this month'))->format('Y-m-d');
        $ultimoDia = (new DateTime('last day of this month'))->format('Y-m-d');
        return [
            'primer_dia' => $primerDia,
            'ultimo_dia' => $ultimoDia,
        ];
    }
}
