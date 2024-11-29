<?php
include "Interfaz.php";
    class Fecha implements DateFacadeInterface{

        public function obtenerFechaHoraActual(){
            $hoy = date('Y-m-d');
            //$hoy = strftime("%d-%m-%Y");
            echo $hoy."\n";
        }

        public function formatearFecha($date){
            $men = [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo',
                'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
                'Noviembre', 'Diciembre'
            ];
        
            $mcz = [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo',
                'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
                'Noviembre', 'Diciembre'
            ];
        
            $date = str_replace($men, $mcz, $date);
        
            $den = [
                'Lunes', 'Martes', 'Miércoles', 'Jueves',
                'Viernes', 'Sábado', 'Domingo'
            ];
        
            $dcz = [
                'Lunes', 'Martes', 'Miércoles', 'Jueves',
                'Viernes', 'Sábado', 'Domingo'
            ];
        
            return str_replace($den, $dcz, $date);
        }
        public function compararFechas($fecha1, $fecha2){}
        public function calcularDiferenciaFechas($fecha1, $fecha2){}
        public function esFechaValida($dia, $mes, $anio){}
        public function modificarFecha($fecha, $modificacion){}
        public function convertirZonaHoraria($fecha, $zonaOrigen, $zonaDestino){}
        public function obtenerFechaNMesesAtras($fecha, $meses){}
        public function obtenerPrimerYUltimoDiaDelMes(){}
    }

    $fechaHoy = new Fecha();
    $fechaHoy->obtenerFechaHoraActual();

    $fechaHoy->formatearFecha('Viernes, 13 de septiembre');





?>