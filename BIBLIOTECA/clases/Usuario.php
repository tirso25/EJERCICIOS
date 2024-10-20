<?php
    class Usuario{
        private $dni;
        private $nombre;
        private $apellido;
        private $direccion;

        public function getDni(){
            return $this -> dni;
        }
        public function getNombre(){
            return $this -> nombre;
        }
        public function getApellido(){
            return $this -> apellido;
        }
        public function getDireccion(){
            return $this -> direccion;
        }

        public function setDni($dni){
            $this -> dni = $dni;
        }
        public function setNombre($nombre){
            $this -> nombre =  $nombre; 
        }
        public function setApellido($apellido){
            $this -> apellido = $apellido;
        }
        public function setDireccion($direccion){
            $this -> direccion = $direccion;
        }
        
        public function __toString(){
            $cadena = "";
    
            $propiedades = get_object_vars($this);
            foreach($propiedades as $propiedad){
                $cadena .= $propiedad . " ";
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
    
        public function toList(){
            $cadena = "";
    
            $propiedades = get_object_vars($this);
            foreach($propiedades as $propiedad){
                $cadena .= "<li>" . $propiedad . "</li>";
            }
    
            return $cadena;
        }
    
        public function toArray(){
            $array = [];
    
            $propiedades = get_object_vars($this);
            foreach($propiedades as $nombre => $propiedad){
                $array[$nombre] = $propiedad;
            }
    
            return $array;
        }
    }