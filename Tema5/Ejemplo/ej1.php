<?php
$transport = array('pie', 'bici', 'coche', 'avión');
$mode = current($transport); // $mode = 'pie';
$mode = next($transport);    // $mode = 'bici';
$mode = next($transport);    // $mode = 'coche';
$mode = prev($transport);    // $mode = 'bici';
$mode = end($transport);     // $mode = 'avión';

?>