<?php
$num1 = readline("Introducen el primer número: ");
$num2 = readline("Introducen el segundo número: ");
$num3 = readline("Introducen el tercer número: ");

if($num1>$num2 && $num1>$num3){
    echo "El número $num1 es el número mayor.";
}
elseif($num2>$num3 && $num2>$num1){
    echo "El número $num2 es el número mayor.";
}
elseif($num3>$num1 && $num3>$num2){
    echo "El número $num3 es el número mayor.";
}
?>
