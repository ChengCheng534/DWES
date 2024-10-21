<?php
class Libro{
    public $titulo, $autor;

    public function __toString(){
        return $this->titulo. " " .$this->autor;
    }
}

$libro = new Libro("DAW","Jose");
$libro -> titulo = "Hola mundo";
$libro -> autor = "yo";

$libro1 = clone $libro;
$libro1 -> titulo = "Adios mundo";
$libro1 -> autor = "tu";

echo $libro ->__toString();
echo "\n";
echo $libro1 ->__toString();
?>