<!-- Crear la interfaz ICocheDAO: esta interfaz debe declarar los métodos CRUD sin especificar detalles de implementación. 
Las clases que la implementen serán responsables de proporcionar las implementaciones concretas.-->
<?php

interface ICocheDAO

{
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
