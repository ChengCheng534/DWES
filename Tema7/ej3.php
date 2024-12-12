<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
    <h2>Calculadora PHP</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">  
        Primer número: 
        <input type="text" name="txtnum1" value="<?php echo isset($_POST['txtnum1']) ? $_POST['txtnum1'] : ''; ?>">
        <br><br>

        Segundo número: 
        <input type="text" name="txtnum2" value="<?php echo isset($_POST['txtnum2']) ? $_POST['txtnum2'] : ''; ?>">
        <br><br>

        Operación: 
        <select name="operacion">
            <option value="vacio" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'vacio') ? 'selected' : ''; ?>>Selecciona una operación</option>
            <option value="suma" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'suma') ? 'selected' : ''; ?>>Suma</option>
            <option value="resta" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'resta') ? 'selected' : ''; ?>>Resta</option>
            <option value="multiplicacion" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'multiplicacion') ? 'selected' : ''; ?>>Multiplicación</option>
            <option value="division" <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'division') ? 'selected' : ''; ?>>División</option>
        </select>
        <br><br>

        <input type="submit" name="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST["txtnum1"];
        $num2 = $_POST["txtnum2"];
        $operacion = $_POST["operacion"];

        if (empty($num1)) {
            echo "<p class='error'>El campo de primer número es obligatorio.</p>";
        } elseif (empty($num2)) {
            echo "<p class='error'>El campo de segundo número es obligatorio.</p>";
        } elseif ($operacion == "vacio") {
            echo "<p class='error'>El campo de operación es obligatorio.</p>";
        } else {
            if (!is_numeric($num1) || !is_numeric($num2)) {
                echo "<p class='error'>Ambos valores deben ser números.</p>";
            } else {
                echo "<h2>Resultado:</h2>";
                if ($operacion == "suma") {
                    $resultado = $num1 + $num2;
                    echo "<p>$num1 + $num2 = $resultado</p>";
                } elseif ($operacion == "resta") {
                    $resultado = $num1 - $num2;
                    echo "<p>$num1 - $num2 = $resultado</p>";
                } elseif ($operacion == "multiplicacion") {
                    $resultado = $num1 * $num2;
                    echo "<p>$num1 * $num2 = $resultado</p>";
                } elseif ($operacion == "division") {
                    if ($num2 == 0) {
                        echo "<p class='error'>La división por cero no está permitida.</p>";
                    } else {
                        $resultado = $num1 / $num2;
                        echo "<p>$num1 / $num2 = $resultado</p>";
                    }
                }
            }
        }
    }
    ?>
</body>
</html>
