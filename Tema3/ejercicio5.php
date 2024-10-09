<?php
$num = rand(1,6);
$dinero = 1000;

$disparo1 = readline("¿Quieres dispararte el primer tiro?");
$gana1= $dinero*2;

if($disparo1=="si" && $num!=1){
    $disparo2=readline("¿Quieres dispararte el segundo tiro?");
    $gana2= $gana1*2;

    if($disparo2=="si" && $num!=2){
        $disparo3=readline("¿Quieres dispararte el tercero tiro? ");
        $gana3= $gana2*2;

        if($disparo3=="si" && $num!=3){
            $disparo4=readline("¿Quieres dispararte el cuarto tiro? ");
            $gana4= $gana3*2;
            
            if($disparo4=="si" && $num!=4){
                $disparo5=readline("¿Quieres dispararte el quinto tiro? ");  
                $gana5= $gana4*2;

                if($disparo5=="si" && $num!=5){
                    echo "Te ganas $gana5 euros. ";
                }elseif($disparo5=="no"){
                    echo "Te ganas $gana4 euros. ";
                }else{
                    echo "Te moriste. ";
                }
            }elseif($disparo4=="no"){
                echo "Te ganas $gana3 euros. ";
            }else{
                echo "Te moriste. ";
            }
        }elseif($disparo3=="no"){
            echo "Te ganas $gana2 euros. ";
        }else{
            echo "Te moriste. ";
        }
    }elseif($disparo2=="no"){
        echo "Te ganas $gana1 euros. ";
    }else{
        echo "Te moriste. ";
    }
}elseif($disparo1=="no"){
    echo "Cobarde(-_-)";
}else{
    echo "Te moriste. ";
}
?>