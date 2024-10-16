<?php
class Palabra {
    // Propiedad privada para almacenar la palabra
    private $texto;

    // Constructor que inicializa la propiedad $texto
    public function __construct($texto) {
        $this->texto = $texto;
    }

    // Método para verificar si la palabra es un palíndromo (ignorando espacios)
    public function esPalindromo() {
        $textoLimpio = str_replace(' ', '', strtolower($this->texto));
        $longitud = strlen($textoLimpio);
        for ($i = 0; $i < $longitud / 2; $i++) {
            if ($textoLimpio[$i] !== $textoLimpio[$longitud - $i - 1]) {
                return false;
            }
        }
        return true;
    }

    // Método para invertir la palabra usando un bucle for
    public function invertir() {
        $invertida = '';
        $longitud = strlen($this->texto);
        for ($i = $longitud - 1; $i >= 0; $i--) {
            $invertida .= $this->texto[$i];
        }
        return $invertida;
    }

    // Método para contar el número de vocales usando un bucle for
    public function contarVocales() {
        $vocales = 'aeiouáéíóúüAEIOUÁÉÍÓÚÜ';
        $contador = 0;
        $longitud = strlen($this->texto);
        for ($i = 0; $i < $longitud; $i++) {
            if (strpos($vocales, $this->texto[$i]) !== false) {
                $contador++;
            }
        }
        return $contador;
    }

    // Método para contar el número de consonantes usando un bucle for
    public function contarConsonantes() {
        $vocales = 'aeiouáéíóúüAEIOUÁÉÍÓÚÜ';
        $contador = 0;
        $longitud = strlen($this->texto);
        for ($i = 0; $i < $longitud; $i++) {
            $caracter = $this->texto[$i];
            if (ctype_alpha($caracter) && strpos($vocales, $caracter) === false) {
                $contador++;
            }
        }
        return $contador;
    }

    // Método para convertir la palabra a mayúsculas usando un bucle for
    public function mayusculas() {
        $resultado = '';
        $longitud = strlen($this->texto);
        for ($i = 0; $i < $longitud; $i++) {
            $resultado .= strtoupper($this->texto[$i]);
        }
        return $resultado;
    }

    // Método para convertir la palabra a minúsculas usando un bucle for
    public function minusculas() {
        $resultado = '';
        $longitud = strlen($this->texto);
        for ($i = 0; $i < $longitud; $i++) {
            $resultado .= strtolower($this->texto[$i]);
        }
        return $resultado;
    }

    // Método para reemplazar las vocales con un carácter dado usando for
    public function reemplazarVocales($caracter) {
        $vocales = 'aeiouáéíóúüAEIOUÁÉÍÓÚÜ';
        $resultado = '';
        $longitud = strlen($this->texto);
        for ($i = 0; $i < $longitud; $i++) {
            if (strpos($vocales, $this->texto[$i]) !== false) {
                $resultado .= $caracter;
            } else {
                $resultado .= $this->texto[$i];
            }
        }
        return $resultado;
    }

    // Método para obtener la longitud de la palabra (sin espacios)
    public function longitud() {
        $longitud = 0;
        $textoLimpio = str_replace(' ', '', $this->texto);
        for ($i = 0; isset($textoLimpio[$i]); $i++) {
            $longitud++;
        }
        return $longitud;
    }

    // Método para verificar si la palabra contiene un carácter específico usando un bucle for
    public function contieneCaracter($caracter) {
        $longitud = strlen($this->texto);
        for ($i = 0; $i < $longitud; $i++) {
            if ($this->texto[$i] === $caracter) {
                return true;
            }
        }
        return false;
    }

    // Método para reemplazar un carácter específico por otro en la palabra usando for
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
        return $resultado;
    }

    // Métodos mágicos para obtener y establecer el valor de la palabra
    public function __get($propiedad) {
        if (property_exists($this, $propiedad)) {
            echo $this->$propiedad;
        }
    }

    public function __set($propiedad, $valor) {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
    }
}

$texto1 = new Palabra("Hola");
echo $texto1->noexixte;
?>
