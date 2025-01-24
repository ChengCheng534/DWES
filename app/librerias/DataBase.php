<?php
    require_once("../config/configurar.php");
    class DataBase{
        private $host = DB_HOST;
        private $usuario = DB_USUARIO;
        private $password = DB_PASSWORD;
        private $nombre_BD = DB_NOMBRE;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct() {
            $dsn = 'msql:host=' . $this->host . ';dbname='. $this->nombre_BD;
            $opciones = array(
                PDO::ATTR_PERSISTENT=>true,
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION 
            );

            try {
                $this->dbh = new PDO($dsn, $this->usuario, $this->password, $opciones);
                $this->dbh = exec('set names utf8');
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error; 
            }
        }

        public function borame(){
            $query = 'select * from usuario';

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $usuarios;
        }

        public function insertarTablas($nombre, $apellidos, $fechaNacimiento, $login, $password, $grupo) {
            $query = "INSERT INTO usuario VALUES(null, '" . $nombre ."', '" .$apellidos."','" .$fechaNacimiento."','" .$login."', '" .$password."', '" .$grupo."')";

            $relsultado = $this->dbh->exec($query);
        }

    }

    $db = new DataBase();
    $contraseña = '5555';
    $hash = password_hash($contraseña, PASSWORD_DEFAULT);
    
    $db->insertarTablas('JORGES','MARTINEZ GARCIA','1994-11-12','JORGEMAQRTINEZ', $hash, 'USUARIO');


?>