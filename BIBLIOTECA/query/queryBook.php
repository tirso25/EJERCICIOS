<?php
    require_once "./clases/Libro.php";
    require_once "./conexion/dbconexion.php";
    class Librodb extends Conexdb{
        public function __construct(){
            parent::db_connect();
        }
        function lanzar_query($query){
            try {
                $resultado = $this -> db_conexion -> prepare($query);
                $resultado->execute();
                $libros = $resultado ->fetchAll(PDO::FETCH_CLASS, 'Libro');
                return $libros;
            } catch (PDOException $error) {
                echo "ERROR FILTRADO" . $error -> getMessage();
                return [];
            }
        }
        public function select_libro(){
            $query = "SELECT codigo, titulo, autor FROM `libro`";
            try {
                $libroCRUD = $this->lanzar_query($query);
                return $libroCRUD;
            } catch (PDOException $error) {
                echo "FALLO SELECT " .$error -> getMessage();
            }
        }
        public function insert_libro(){
            if(isset($_POST['insert_submit_libro'])){
                $db_insert_title = validar($_POST['insert_title']);
                $db_insert_autor = validar($_POST['insert_autor']);
                
                $query = "INSERT INTO libro VALUES ('NULL','$db_insert_title', '$db_insert_autor')";
                try {
                    $libros_insert = $this->lanzar_query($query);
                    return $libros_insert;
                } catch (PDOException $error) {
                    echo "ERROR INSERCION LIBRO" . $error->getMessage();
                }
            }
            
        }
        public function delete_book(){
            if(isset($_POST['delete_book'])){
                $db_cod = validar($_POST['delete_cod']);
                $query = "DELETE FROM libro WHERE codigo = '$db_cod'";

                try {
                    $resultado = $this -> db_conexion -> prepare($query);
                    $resultado->execute();
                } catch (PDOException $error) {
                    echo "ERROR ELIMINACION LIBRO" . $error->getMessage();
                }
            }
        }
        public function filter_book(){
            $librosFILTRO = [];
            if(isset($_POST['filter_submit_libro'])){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $contador = 0;
                    $db_filter_cod = validar($_POST['filter_cod']);
                    $db_filter_title = validar($_POST['filter_title']);
                    $db_filter_autor = validar($_POST['filtert_autor']);

                    if(!empty($db_filter_cod) && $contador != 1){
                        $contador = 1;
                        $query = "SELECT codigo, titulo, autor FROM `libro` WHERE codigo LIKE '%' '$db_filter_cod' '%' LIMIT 0, 25";
                        
                        $librosFILTRO = $this -> lanzar_query($query);
                    }
                    if(!empty($db_filter_title) && $contador != 1){
                        $contador = 1;
                        $query = "SELECT codigo, titulo, autor FROM `libro` WHERE codigo LIKE '%' '$db_filter_title' '%' LIMIT 0, 25";
                        $librosFILTRO = $this -> lanzar_query($query);
                    }
                    if(!empty($db_filter_autor) && $contador != 1){
                        $contador = 1;
                        $query = "SELECT codigo, titulo, autor FROM `libro` WHERE codigo LIKE '%' '$db_filter_autor' '%' LIMIT 0, 25";
                        $librosFILTRO = $this -> lanzar_query($query);
                    }
                }
            }
            return $librosFILTRO;
        }
    }