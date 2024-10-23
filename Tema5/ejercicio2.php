<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $num = array();

        for ($i=0; $i < 100; $i++) { 
            $num[] = rand(1,50);
        }

        echo $num." ";
        $mayor = max($num);
        $menor = min($num);
        $media = media($num);

        
        function mayor($num){
        }

        echo $mayor;
        echo $menor;


        function menor(){

        }

        function media(){

        }

        ?>
</body>
</html>
