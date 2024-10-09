<?php

$num1 = rand(10,500);
$num2 = rand(10,500);
$num3 = rand(10,500);
$num4 = rand(10,500);
$num5 = rand(10,500);

//echo '<svg width="300" height="130" xmlns="http://www.w3.org/2000/svg">';
//echo '  <rect width="200" height="100" x="10" y="10" rx="20" ry="20" fill="blue" />';
//echo '</svg>';

echo "<svg width=\"600\" height=\"60\" xmlns=\"http://www.w3.org/2000/svg\">";
echo "  <rect width=\"$num1\" height=\"50\" x=\"10\" y=\"10\" rx=\"20\" ry=\"20\" fill=\"blue\" />";
echo "</svg>";
echo "<b>$num1</b>";
echo "<br>";
echo "<svg width=\"600\" height=\"60\" xmlns=\"http://www.w3.org/2000/svg\">";
echo "  <rect width=\"$num2\" height=\"50\" x=\"10\" y=\"10\" rx=\"20\" ry=\"20\" fill=\"red\" />";
echo "</svg>";
echo "<b>$num2</b>";
echo "<br>";
echo "<svg width=\"600\" height=\"60\" xmlns=\"http://www.w3.org/2000/svg\">";
echo "  <rect width=\"$num3\" height=\"50\" x=\"10\" y=\"10\" rx=\"20\" ry=\"20\" fill=\"black\" />";
echo "</svg>";
echo "<b>$num3</b>";
echo "<br>";
echo "<svg width=\"600\" height=\"60\" xmlns=\"http://www.w3.org/2000/svg\">";
echo "  <rect width=\"$num4\" height=\"50\" x=\"10\" y=\"10\" rx=\"20\" ry=\"20\" fill=\"green\" />";
echo "</svg>";
echo "<b>$num4</b>";
echo "<br>";
echo "<svg width=\"600\" height=\"60\" xmlns=\"http://www.w3.org/2000/svg\">";
echo "  <rect width=\"$num5\" height=\"50\" x=\"10\" y=\"10\" rx=\"20\" ry=\"20\" fill=\"yellow\" />";
echo "</svg>";
echo "<b>$num5</b>";
?>