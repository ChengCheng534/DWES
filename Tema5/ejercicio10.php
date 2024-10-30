<?php
    class Cliente{
        private $id, $nombre, $telefono, $edad;

        public function __construct($id, $nombre, $telefono, $edad){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->edad = $edad;
        }

        public function __get($propiedad) {
            if (property_exists($this, $propiedad)) {
                return $this->$propiedad;
            }
        }

        public function __toString(){
            $mostrar = "ID: ".$this->id."; Nombre: ".$this->nombre."; Teléfono: ".$this->telefono."; Edad: ".$this->edad;
            return $mostrar;
        }
    }
    
    $cliente1 = new Cliente("c1", "cliente1","111111111","1");
    $cliente2 = new Cliente("c2", "cliente2","222222222","2");
    $cliente3 = new Cliente("c3", "cliente3","333333333","3");
    $cliente4 = new Cliente("c4", "cliente4","444444444","4");
    $cliente5 = new Cliente("c5", "cliente5","555555555","5");
    $cliente6 = new Cliente("c6", "cliente6","666666666","6");
    $cliente7 = new Cliente("c7", "cliente7","777777777","7");
    $cliente8 = new Cliente("c8", "cliente8","888888888","8");
    $cliente9 = new Cliente("c9", "cliente9","999999999","9");
    $cliente10 = new Cliente("c10", "cliente10","101010101","10");

    $arrayClientes = [
        $cliente1->id => $cliente1, 
        $cliente2->id => $cliente2,
        $cliente3->id => $cliente3,
        $cliente4->id => $cliente4,
        $cliente5->id => $cliente5,
        $cliente6->id => $cliente6,
        $cliente7->id => $cliente7,
        $cliente8->id => $cliente8,
        $cliente9->id => $cliente9,
        $cliente10->id => $cliente10,
    ];

    /*
    $arrayClientes = array(
        $cliente1->id => $cliente1, 
        $cliente2->id => $cliente2,
        $cliente3->id => $cliente3,
        $cliente4->id => $cliente4,
        $cliente5->id => $cliente5,
        $cliente6->id => $cliente6,
        $cliente7->id => $cliente7,
        $cliente8->id => $cliente8,
        $cliente9->id => $cliente9,
        $cliente10->id => $cliente10,
    );
    */

    $menu = <<<'MENU'
    1.Mostrar el primer cliente.
    2.Mostrar el último cliente.
    3.Mostrar el siguiente cliente.
    4.Mostrar el anterior cliente.
    5.Mostrar listado completo.
    6.Salir del programa.
    MENU;
    echo $menu;

    echo "\n";
    $opcion = readline("Introducen el número de opción: ");

    while ($opcion < 6) {
        $resultado;
        $puntero;
        if ($opcion == 1) {
            echo reset($arrayClientes)."\n";
        }elseif ($opcion == 2){
            echo end($arrayClientes)."\n";
        }elseif ($opcion == 3) {
            $aux = next($arrayClientes);
            if ($aux == false){
                echo "NO HAY REGISTROS EN LA DIRECCIÓN INDICADA\n";
                end($arrayClientes);
            }else{
                echo $aux."\n";
            }
        }elseif ($opcion == 4) {
            $aux = prev($arrayClientes);
            if ($aux == false) {
                echo "NO HAY REGISTROS EN LA DIRECCIÓN INDICADA\n";
                reset($arrayClientes);
            }else{
                echo $aux."\n";
            }
        }elseif ($opcion == 5){
            foreach ($arrayClientes as $cliente) {
                echo $cliente . "\n";
            }
        }

        $opcion = readline("Introducen el número de opción: ");
    }

?>
