<?php
    class Cliente{
        private $db;

        public function __construct() {
            $this->db = new DataBase();
        }

        public function obtenerClientes() {
            $this->db->query("SELECT * from Cliente");
    
            $resultados = $this->db->registros();
            return $resultados;
        }

        public function agregarClientes($datos){
            $this->db->query("INSERT INTO cliente (documento_identidad, nombre, apellidos, email, telefono, direccion, fecha_nacimiento, fotografia) VALUES (:documento_identidad, :nombre, :apellidos, :email, :telefono, :direccion, :fecha_nacimiento, :fotografia)");
    
            // Vinculamos los valores
            $this->db->bind(":documento_identidad", $datos["documento_identidad"]);
            $this->db->bind(":nombre", $datos["nombre"]);
            $this->db->bind(":apellidos", $datos["apellidos"]);
            $this->db->bind(":nombre", $datos["nombre"]);
            $this->db->bind(":email", $datos["email"]);
            $this->db->bind(":telefono", $datos["telefono"]);
            $this->db->bind(":direccion", $datos["direccion"]);
            $this->db->bind(":fecha_nacimiento", $datos["fecha_nacimiento"]);
            $this->db->bind(":fotografia", $datos["fotografia"]);
    
            // Ejecutar la consulta
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function obtenerCliente($cliente_id){
            $this->db->query("SELECT * from Cliente where cliente_id=$cliente_id");
    
            $resultados = $this->db->registros();
            return $resultados;
        }

        public function borrarCliente($cliente_id){
            $this->db->query("DELETE FROM Cliente WHERE cliente_id=$cliente_id");

            $resultados = $this->db->registros();
            return $resultados;
        }

        public function editarCliente($datos){
            $this->db->query("UPDATE cliente SET DOCUMENTO_IDENTIDAD=:identidad, nombre=:nombre, apellidos=:apellidos, email=:email, telefono=:telefono, direccion=:direccion, fecha_nacimiento=:fechaNac, fotografia=:foto WHERE cliente_id=:cliente_id");

            // Vinculamos los valores
            $this->db->bind(":cliente_id", $datos["cliente_id"]);
            $this->db->bind(":documento_identidad", $datos["documento_identidad"]);
            $this->db->bind(":nombre", $datos["nombre"]);
            $this->db->bind(":apellidos", $datos["apellidos"]);
            $this->db->bind(":nombre", $datos["nombre"]);
            $this->db->bind(":email", $datos["email"]);
            $this->db->bind(":telefono", $datos["telefono"]);
            $this->db->bind(":direccion", $datos["direccion"]);
            $this->db->bind(":fecha_nacimiento", $datos["fecha_nacimiento"]);
            $this->db->bind(":fotografia", $datos["fotografia"]);
    
            // Ejecutar la consulta
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }
?>