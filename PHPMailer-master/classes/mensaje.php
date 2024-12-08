<?php
    class Mensaje {
        private $destinatario;
        private $asunto;
        private $cuerpo;
        private $cc;
        private $cco;
        private $adjuntos;
    
        public function __construct($destinatario, $asunto, $cuerpo) {
            $this->destinatario = is_array($destinatario) ? $destinatario : [$destinatario];
            $this->asunto = $asunto;
            $this->cuerpo = $cuerpo;
            $this->cc = [];
            $this->cco = [];
            $this->adjuntos = [];
        }
    
        public function __get($propiedad) {
            if (property_exists($this, $propiedad)) {
                return $this->$propiedad;
            }
            return null;
        }
    
        public function __set($propiedad, $valor) {
            if (property_exists($this, $propiedad)) {
                $this->$propiedad = $valor;
            }
        }
    
        public function addDestinatario($email) {
            if(!in_array($email, $this->destinatario)) {
                $this->destinatario[] = $email;
            } else {
                echo "Ya esta puesto";
               return false;
            }

        }
    
        public function removeDestinatarioByIndex($index) {
            if (isset($this->destinatario[$index])) {
                unset($this->destinatario[$index]);
                $this->destinatario = array_values($this->destinatario);
            }
        }
    
        public function addCC($email) {
            if(!in_array($email,$this->cc)) {
                $this->cc[] = $email;
            } else {
                echo "Ya esta puesto";
                return false;
            }
        }
    
        public function removeCCByIndex($index) {
            if (isset($this->cc[$index])) {
                unset($this->cc[$index]);
                $this->cc = array_values($this->cc);
            }
        }
    
        public function addCCO($email) {
            if(!in_array($email,$this->cco)) {
                $this->cco[] = $email;

            } else {
                echo "Ya esta puesto";
                return false;
            }
        }
    
        public function removeCCOByIndex($index) {
            if (isset($this->cco[$index])) {
                unset($this->cco[$index]);
                $this->cco = array_values($this->cco);
            } 
        }
    
        public function addAdjunto($filePath) {
            if(!in_array($filePath, $this->adjuntos)) {
                $this->adjuntos[] = $filePath;
            } else {
                echo "Ya esta puesto";
               return false;
            }
        }
    
        public function removeAdjuntoByIndex($index) {
            if (isset($this->adjuntos[$index])) {
                unset($this->adjuntos[$index]);
                $this->adjuntos = array_values($this->adjuntos);
            }
        }

        public function __toString() {
        	return "|Destinatario: " . implode(", ", $this->destinatario)
                    ."\n|CC: " . implode(", ", $this->cc)
                    ."\n|CCO:"  . implode(", ", $this->cco)
                    ."\n|Asunto: {$this->asunto} \n|Cuerpo:\n {$this->cuerpo} \n|Adjuntos: " 
                    . implode(", ", $this->adjuntos);
        }
    }
?>
