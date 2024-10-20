<?php
    class Palabra{
        private $texto;

        public function __construct($texto){
            $this->texto = $texto;
        }
        public function esPalindromo(){
            $textoLimpio = str_replace(' ', '', strtolower($this->texto));
            $longitud = strlen($textoLimpio);
            $cadena = "";
            $cadenaR = "";
            
            for ($i = 0; $i < $longitud; $i++) {
                $cadena .=$textoLimpio[$i];
            }
            for ($i=$longitud-1; $i >=0 ; $i--) { 
                $cadenaR .=$textoLimpio[$i];
            }
            
            if ($cadena != $cadenaR) {
                return "No es polindramo\n";
            }else{
                return "Es polindramo\n";
            }
        }
        public function invertir(){
            $invertir = '';
            $longitud = strlen($this->texto);

            for ($i=$longitud-1; $i >=0 ; $i--) { 
                $invertir .=$this->texto[$i];
            }
            return $invertir."\n";
        }
        public function contarVocales(){
            $vocales="aeiouAEIOU";
            $contador = 0;
            $longitud = strlen($this->texto);
            for ($i = 0; $i < $longitud; $i++) {
                if (strpos($vocales, $this->texto[$i]) !== false) {
                    $contador++;
                }
            }
            return $contador."\n";
        }
        public function contadorConsonantes(){
            $consonates="bcdfghjklmnñpqrstvwxyzBCDFGHJKLMNÑPQRSTVWXYZ";
            $contador = 0;
            $longitud = strlen($this->texto);
            for ($i = 0; $i < $longitud; $i++) {
                if (strpos($consonates, $this->texto[$i]) !== false) {
                    $contador++;
                }
            }
            return $contador."\n";
        }
        public function mayusculas(){
            $longitud = strlen($this->texto);
            $resultado = '';

            for ($i=0; $i < $longitud ; $i++) { 
                $resultado .= strtoupper($this->texto[$i]);
            }
            echo $resultado."\n";
        }
        public function minusculas(){
            $longitud = strlen($this->texto);
            $resultado = '';

            for ($i=0; $i <  $longitud ; $i++) { 
                $resultado.=strtolower($this->texto[$i]);
            }
            return $resultado."\n";
        }
        public function reemplazarVocales($caracter){
            $vocales="aeiouAEIOU";
            $longitud = strlen($this->texto);
            $resultado='';
            for ($i = 0; $i < $longitud; $i++) {
                if (strpos($vocales, $this->texto[$i]) !== false) {
                    $resultado .= $caracter;
                } else {
                    $resultado .= $this->texto[$i];
                }
            }
            return $resultado."\n";
        }
        public function longitud() {
            $longitud = 0;
            $textoLimpio = str_replace(' ', '', $this->texto);
            for ($i = 0; isset($textoLimpio[$i]); $i++) {
                $longitud++;
            }
            return $longitud."\n";
        }
        public function contieneCaracter($caracter) {
            $longitud = strlen($this->texto);
            for ($i = 0; $i < $longitud; $i++) {
                if ($this->texto[$i] === $caracter) {
                    return "Exite el caracter $caracter\n";
                }
            }
            return "NO exixte el caracter $caracter\n";
        }
        public function reemplazarCaracter($buscar, $reemplazar) {
            $resultado = '';
            $longitud = strlen($this->texto);
            for ($i = 0; $i < $longitud; $i++) {
                if ($this->texto[$i] === $buscar) {
                    $resultado .= $reemplazar;
                } else {
                    $resultado .= $this->texto[$i];
                }
            }
            return $resultado."\n";
        }
        public function __get($propiedad) {
            if (property_exists($this, $propiedad)) {
                return $this->$propiedad."\n";
            }
        }
        public function __set($propiedad, $valor) {
            if (property_exists($this, $propiedad)) {
                $this->$propiedad = $valor."\n";
            }
        }
    }

    echo "<br>Metodo 1:\t";
    $texto1 = new Palabra("Amo la paloma");
    echo $texto1->esPalindromo();

    echo "<br>Metodo 2:\t";
    echo $texto1->invertir();

    echo "<br>Metodo 3:\t";
    echo $texto1->contarVocales();

    echo "<br>Metodo 4:\t";
    echo $texto1->contadorConsonantes();

    echo "<br>Metodo 5:\t";
    echo $texto1->mayusculas();

    echo "<br>Metodo 6:\t";
    echo $texto1->minusculas();

    echo "<br>Metodo 7:\t";
    echo  $texto1->reemplazarVocales("o");

    echo "<br>Metodo 8:\t";
    echo  $texto1->longitud();

    echo "<br>Metodo 9:\t";
    echo  $texto1->contieneCaracter("a");

    echo "<br>Metodo 10:\t";
    echo  $texto1->reemplazarCaracter("a","e");

    echo "<br>Metodo 11:\t";


?>