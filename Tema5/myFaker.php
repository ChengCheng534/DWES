<?php

    if(php_sapi_name() == "cli"){
        echo "consola:\n";
        require_once("Faker-Master/src/autoload.php");
    }else{
        echo "navegador:";
        require_once "../Faker-Master/src/autoload.php";
    }

$faker = Faker\Factory::create('es_ES');
for ($i=0; $i < 10; $i++) { 
    echo "Prueba ".$i." con faker:\t".$faker->name."\n";
    //echo "Prueba ".$i." con faker:\t".$faker->address."\n";
    //echo "Prueba ".$i." con faker:\t".$faker->text."\n";
    //echo "Prueba ".$i." con faker:\t".$faker->safeColorName."\n";
    //echo "Prueba ".$i." con faker:\t".$faker->safeHexColor."\n";
}


?>