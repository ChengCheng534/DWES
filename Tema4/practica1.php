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
                    return true."Si exite\n";
                }
            }
            return "NO exixte\n";
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
    $texto1 = new Palabra("ala vala");
    echo $texto1->esPalindromo();

    echo "<br>Metodo 2:\t";
    $texto2 = new Palabra("Hola Mundo");
    echo $texto2->invertir();

    echo "<br>Metodo 3:\t";
    $texto3 = new Palabra("Adios Mundo");
    echo $texto3->contarVocales();

    echo "<br>Metodo 4:\t";
    $texto4 = new Palabra("Desarrollo de Aplicaiones Web en Entornos Servidor");
    echo $texto4->contadorConsonantes();

    echo "<br>Metodo 5:\t";
    $texto5 = new Palabra("desarrollo de aplicaciones web");
    echo $texto5->mayusculas();

    echo "<br>Metodo 6:\t";
    $texto6 = new Palabra("DESARROLLO DE APLICACIONES WEB");
    echo $texto6->minusculas();

    echo "<br>Metodo 7:\t";
    $texto7 = new Palabra("Reemplazar Vocales");
    echo  $texto7->reemplazarVocales("o");

    echo "<br>Metodo 8:\t";
    $texto8 = new Palabra("Longitud de palabra");
    echo  $texto8->longitud();

    echo "<br>Metodo 9:\t";
    $texto9 = new Palabra("Contiene caracter");
    echo  $texto9->contieneCaracter("");

    echo "<br>Metodo 10:\t";
    $texto10 = new Palabra("Reemplazar caracter");
    echo  $texto10->reemplazarCaracter("a","e");

    echo "<br>Metodo 11:\t";


?>