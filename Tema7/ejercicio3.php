<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
    //$num1 = $_POST["txtnum1"];
    //$num2 = $_POST["txtnum2"];
    //$operacion = $_POST["operacion"];

    // define variables and set to empty values
    $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $name = $email = $gender = $comment = $website = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["txtnum1"])) {
            $num1Err = "Numero 1 es requerido";
        }else{
            $num1 = test_input($_POST["txtnum1"]);
        }

        if (empty($_POST["txtnum2"])) {
            $num2Err = "Numero 2 es requerido";
        }else{
            $num2 = test_input($_POST["txtnum2"]);
        }

        if ($_POST["operacion"] == "vacio") {
            $operErr = "Operacion es requerido";
        }else{
            $operacion = test_input($_POST["operacion"]);
            $resultado = 0;
            if($operacion == "suma"){
                $resultado = $num1 + $num2;
            }elseif ($operacion == "resta") {
                $resultado = $num1 - $num2;
            }elseif ($operacion == "multiplicacion") {
                $resultado = $num1 * $num2;
            }elseif ($operacion == "division"){
                $resultado = $num1 / $num2;
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">  
        <label for="num1">Primer número:</label>
        <input id="numero1" 
            type="number" 
            name="txtnum1" 
            placeholder="Introduce el primer número">
        <span class="error">* 
            <?php echo $num1Err;?>
        </span>
        <br>

        <label for="operaciones">Operaciones: </label>
        <select name="operacion" id="operacion">
            <option value="vacio"></option>
            <option value="suma">Sumar</option>
            <option value="resta">Restar</option>
            <option value="multiplicacion">Multiplicar</option>
            <option value="division">Dividir</option>
        </select>
        <span class="error">*
            <?php echo $operErr;?>
        </span>
        <br>
        
        <label for="num2">Segundo número:</label>
        <input id="numero2" 
            type="number" 
            name="txtnum2" 
            placeholder="Introduce el segundo número">
        <span class="error">
            <?php echo $num2Err;?>
        </span>
        <br>

        <input type="submit" name="submit" value="Calcular" value="Submit">
    </form>

<?php
    echo "<h2>Tu datos de calculo:</h2>";
    echo "<br>";
    echo "Primer número: ".$num1;
    echo "<br>";
    echo "Operacion: ".$operacion;
    echo "<br>";
    echo "Segundo número: ".$num2;
    echo "<br>";
    echo "Resultado: ".$resultado;
?>

</body>
</html>