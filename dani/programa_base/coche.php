<!-- Creación de la clase Coche: primero debemos crear una clase PHP que representará el Coche con las siguientes propiedades:
Matricula (string)
Marca (string)
Modelo (string)
Potencia (número)
Velocidad máxima (número) -->

<?php

class Coche
{
    private $matricula, $marca, $modelo, $potencia, $velocidadMaxima, $imagen;

    public function __construct($matricula, $marca, $imagen)
    {
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->imagen = $imagen;
    }

    public function __toString()
    {
        return $this->matricula . " " . $this->marca . " " . $this->modelo . " " . $this->potencia . " " . $this->velocidadMaxima;
    }
    public function __get($propiedad)
    {
        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        } else {
            return "No existe la propiedad: $propiedad";
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
