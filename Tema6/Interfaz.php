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
?>