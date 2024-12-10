<?php
    $num1 = $_POST["txtnum1"];
    $num2 = $_POST["txtnum2"];

    if (empty($num1)) {
        echo "El campo de numero 1 es obrigatorio.";
    }elseif (empty($num2)) {
        echo "El campo de numero 2 es obrigatorio.";
    }
    echo $num1;
    echo $num2;

?>