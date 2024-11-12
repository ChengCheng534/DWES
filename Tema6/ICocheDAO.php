<?php
interface ICocheDAO {
    // Alta de coche
    public function crear(Coche $coche); 

    // Devuelve el coche buscado	
    public function obtenerCoche($matricula); 

    // Borrado de coche
    public function eliminar($matricula); 

    // Modificación de Coche
    public function actualizar($matricula, Coche $nuevoCoche); 

    // devuelve todos los coches almacenados en el fichero
    public function verTodos(); 
}
?>