<?php

$cir1 = rand(10,125);
$cir2 = rand(10,125);
$cir3 = rand(10,125);
$cir4 = rand(10,125);
$cir5 = rand(10,125);

$cx1 = rand(100,750);
$cy1 = rand(100,750);
$cx2 = rand(100,750);
$cy2 = rand(100,750);
$cx3 = rand(100,750);
$cy3 = rand(100,750);
$cx4 = rand(100,750);
$cy4 = rand(100,750);
$cx5 = rand(100,750);
$cy5 = rand(100,750);

echo "<svg height=\"1000\" width=\"1000\" xmlns=\"http://www.w3.org/2000/svg\">
    <circle r=\"$cir1\" cx=\"$cx1\" cy=\"$cy1\" fill=\"yellow\" />
    <circle r=\"$cir2\" cx=\"$cx2\" cy=\"$cy2\" fill=\"violet\" />
    <circle r=\"$cir3\" cx=\"$cx3\" cy=\"$cy3\" fill=\"red\" />
    <circle r=\"$cir4\" cx=\"$cx4\" cy=\"$cy4\" fill=\"green\" />
    <circle r=\"$cir5\" cx=\"$cx5\" cy=\"$cy5\" fill=\"blue\" />
</svg><br>";
?>