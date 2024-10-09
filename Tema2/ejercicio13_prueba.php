<?php

$cir1 = rand(10,75);
$cir2 = rand(10,75);
$cir3 = rand(10,75);
$cir4 = rand(10,75);
$cir5 = rand(10,75);

$cx = rand(100,750);
$cy = rand(100,750);

echo "<svg height=\"1000\" width=\"1000\" xmlns=\"http://www.w3.org/2000/svg\">
    <circle r=\"$cir1\" cx=\"$cx\" cy=\"$cy\" fill=\"yellow\" />
    <circle r=\"$cir2\" cx=\"$cx\" cy=\"$cy\" fill=\"black\" />
    <circle r=\"$cir3\" cx=\"$cx\" cy=\"$cy\" fill=\"blue\" />
    <circle r=\"$cir4\" cx=\"$cx\" cy=\"$cy\" fill=\"yellow\" />
    <circle r=\"$cir5\" cx=\"$cx\" cy=\"$cy\" fill=\"yellow\" />
</svg><br>";
?>