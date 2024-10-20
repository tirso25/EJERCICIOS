<?php
    class Prestar{
        private $dni_user;
        private $cod_libro;
        private $fecha_entrega;

        public function getDniUser(){
            return $this -> dni_user;
        }
        public function getCodLibro(){
            return $this -> cod_libro;
        }
        public function getFechaEntrega(){
            return $this -> fecha_entrega;
        }

        public function setDniUser($dni_user){
            $this -> dni_user = $dni_user;
        }
        public function setCodLibro($cod_libro){
            $this -> cod_libro = $cod_libro;
        }
        public function setFechaEntrega($fecha_entrega){
            $this -> fecha_entrega = $fecha_entrega;
        }

        public function __tostring(){
            $cadena = "";

            $propierties = get_object_vars($this);

            foreach($propierties as $i){
                $cadena .= "".$i." ";;
            }

            return $cadena;
        }

        public function toTable(){
            $cadena = "";
    
            $propiedades = get_object_vars($this);
            foreach($propiedades as $propiedad){
                $cadena .= "<td>" . $propiedad . "</td>";
            }
    
            return $cadena;
        }
    }
?>