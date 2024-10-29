<?php
    function doble($n){
        return $n*2;
    }
    function triple($n){
        return $n*3;
    }
    function cuadrodo($n){
        return $n*$n;
    }
    function cubo($n){
        return $n*$n*$n;
    }

    $valor = array(2,4,6,8,10,12,14,18,20,22);
    $af = array("double","triple","cuadrado","cubo");

    foreach($valor as $e){
        foreach ($af as $funcion) {
            echo $funcion($e)."";
        }
    }
?>