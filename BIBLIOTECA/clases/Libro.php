<?php
    class Libro{
        private $codigo;
        private $titulo;
        private $autor;
        
        public function getCodigo(){
            return $this -> codigo;
        }
        public function getTirulo(){
            return $this -> titulo;
        }
        public function getAutor(){
            return $this -> autor;
        }

        public function setCodigio($codigo){
            return $this -> codigo = $codigo;
        }
        public function setTitulo($titulo){
            return $this -> titulo = $titulo;
        }
        public function setAutor($autor){
            return $this -> autor = $autor;
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