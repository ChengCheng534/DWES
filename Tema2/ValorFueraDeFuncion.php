<?php

function text(){
    //Guardar su valor fuera del función gracias a 'static'.
    static $contador = 0;

    //Este variable pierde su valor fuera de función.
    //$contador = 0; 
    
    echo $contador;
    $contador++;
}

text();
text();
text();

?>
