<?php
    $num1 = $_POST["txtnum1"];
    $num2 = $_POST["txtnum2"];
    $operacion = $_POST["operacion"];

    if (empty($num1)) {
        echo "El campo de primer numero es obrigatorio.";
    }elseif (empty($num2)) {
        echo "El campo de segundo numero es obrigatorio.";
    }elseif ($operacion == "vacio") {
        echo "El campo de operacion es obrigatorio.";
    }else{
        if($operacion == "suma"){
            $suma = $num1 + $num2;
            echo "Resultado: ".$suma;
        }elseif ($operacion == "resta") {
            $resta = $num1 - $num2;
            echo "Resultado: ".$resta;
        }elseif ($operacion == "multiplicacion") {
            $multiplicacion = $num1 * $num2;
            echo "Resultado: ".$multiplicacion;
        }elseif ($operacion == "division"){
            $division = $num1 / $num2;
            echo "Resultado: ".$division;
        }
    }
?>