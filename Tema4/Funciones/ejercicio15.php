<?php
    class DBConnection{
        public $db;

        public function __construct($db){
            $this->db = $db;
            echo "Conectado a la base de datos '$this->db'...\n";
        }

        public function __destruct(){
            echo "Desconectado de la base de datos '$this->db'...\n";
        }

    }

$conexion1 = new DBConnection("MiDB");

?>