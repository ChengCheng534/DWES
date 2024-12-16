<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$number1Err = $number2Err = $operErr = "";
$number1 = $number2 = $operation = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["number1"])) {
    $number1Err = "Number 1 is required";
  } else {
    $number1 = test_input($_POST["number1"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[1-9]*$/",$number1)) {
      $number1 = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["number1"])) {
    $number2Err = "Number 2 is required";
  } else {
    $number2 = test_input($_POST["number2"]);
    // check if e-mail address is well-formed
    if (!preg_match("/^[1-9]*$/",$number2)) {
      $number2 = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["operation"])) {
    $operErr = "Operation is required";
  } else {
    $operation = test_input($_POST["operation"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

  Number 1: <input type="number" name="number1" value="<?php echo $number1;?>">
  <span class="error">* <?php echo $number1Err;?></span>
  <br><br>

  Number 2: <input type="number" name="number2" value="<?php echo $number2;?>">
  <span class="error">* <?php echo $number2Err;?></span>
  <br><br>

  Operation:
  <select name="operacion" id="operacion">
    <option value="suma" name="suma" <?php if (isset($suma) && $gender=="female") echo "checked";?> value="female">Female>Sumar</option>
    <option value="resta">Restar</option>
    <option value="multiplicacion">Multiplicar</option>
    <option value="division">Dividir</option>
  </select>

  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $operErr;?></span>
  <br><br>



  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";

?>

</body>
</html>