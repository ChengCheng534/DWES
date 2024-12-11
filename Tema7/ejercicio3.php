<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
    $num1 = $_POST["txtnum1"];
    $num2 = $_POST["txtnum2"];
    $operacion = $_POST["operacion"];

    // define variables and set to empty values
    $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $name = $email = $gender = $comment = $website = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($num1)) {
            $nameErr = "Numero 1 es requerido";
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
    }
?>
    <form action="ejercicio2.php" method="POST">
        <label for="num1">Primer número:</label>
        <input id="numero1" type="number" name="txtnum1" placeholder="Introduce el primer número">
        <br>

        <label for="operaciones">Operaciones: </label>
        <select name="operacion" id="operacion">
            <option value="vacio"></option>
            <option value="suma">Sumar</option>
            <option value="resta">Restar</option>
            <option value="multiplicacion">Multiplicar</option>
            <option value="division">Dividir</option>
        </select>
        <br>

        <label for="num2">Segundo número:</label>
        <input id="numero2" type="number" name="txtnum2" placeholder="Introduce el segundo número">
        <br>

        <input type="submit" value="Calcular">
    </form>