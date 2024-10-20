<?php
    require_once "./clases/Usuario.php";
    require_once "./conexion/dbconexion.php";
    class Usuariodb extends Conexdb{
        public function __construct(){
            parent::db_connect();
        }
        public function validar($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }
        function lanzar_query($query) { 
            try {
                $resultado = $this -> db_conexion->prepare($query);
                $resultado->execute();
                $usuarios = $resultado -> fetchAll(PDO::FETCH_CLASS, 'Usuario');
                return $usuarios;
            } catch (PDOException $error) {
                echo "ERROR FILTRADO: " . $error->getMessage();
                return [];
            }
        }
        public function getUser(){
            $db_modify_user = validar($_POST['modify_dni']);
            $query = "SELECT dni, nombre, apellido, direccion  FROM `usuario` WHERE dni = '$db_modify_user'";

            try {
                $resultado = $this -> db_conexion -> prepare($query);
                $resultado->execute();
                $resultado->setFetchMode(PDO::FETCH_ASSOC);
                $usuario_dni = $resultado->fetch();
                return $usuario_dni;
            } catch (PDOException $error) {
                echo "ERROR OBTENCION EMPLEADO" .  $error->getMessage();
            }
        }
        public function select_usuario(){
            $query = "SELECT dni, nombre, apellido, direccion  FROM `usuario`";
            try {    
                $cruUsers = $this->lanzar_query($query);
                return $cruUsers;
            } catch (PDOException $error) {
                echo "FALLO SELECT " . $error -> getMessage();
            }
        }
        public function filter_user(){
            $usuariosFILTRO = [];
            if(isset($_POST["filter_submit"])){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $contador = 0;
                    $db_dni = validar($_POST["filter_dni"]);
                    $db_name = validar($_POST["filter_name"]);
                    $db_addres = validar($_POST["filter_addres"]);
                    $db_direction = validar($_POST["filter_direccion"]);
    
                    if(!empty($db_dni) && $contador != 1){
                        $query = "SELECT dni, nombre, apellido, direccion FROM usuario WHERE dni LIKE '%' '$db_dni' '%' LIMIT 0, 25";
                
                        $usuariosFILTRO = $this->lanzar_query($query);
                        $contador = 1;
                    }
                    if(!empty($db_name) && $contador != 1){
                        $query = "SELECT dni, nombre, apellido, direccion FROM usuario WHERE nombre LIKE '%' '$db_name' '%' LIMIT 0, 25";
                
                        $usuariosFILTRO = $this->lanzar_query($query);
                        $contador = 1;
                    }
                    if(!empty($db_addres) && $contador != 1){
                        $query = "SELECT dni, nombre, apellido, direccion FROM usuario WHERE apellido LIKE '%' '$db_addres' '%' LIMIT 0, 25";
                
                        $usuariosFILTRO = $this->lanzar_query($query);
                        $contador = 1;
                    }
                    if(!empty($db_direction) && $contador != 1){
                        $query = "SELECT dni, nombre, apellido, direccion FROM usuario WHERE direccion LIKE '%' '$db_direction' '%' LIMIT 0, 25";
                
                        $usuariosFILTRO = $this->lanzar_query($query);
                        $contador = 1;
                    }
                }
                return $usuariosFILTRO;
            }
        }
        public function insert_user(){
            if(isset($_POST["insert_submit"])){
                $db_dni = validar($_POST["insert_dni"]);
                $db_name = validar($_POST["insert_name"]);
                $db_addres = validar($_POST["insert_addres"]);
                $db_direction = validar($_POST["insert_direction"]);

                $query = "INSERT INTO usuario VALUES ('$db_dni', '$db_name', '$db_addres', '$db_direction')";
                try {
                    $usuarios_insert = $this->lanzar_query($query);
                    return $usuarios_insert;
                } catch (PDOException $error) {
                    echo "ERROR INSERCION". $error->getMessage();
                }
            }
        }
        public function delete_user(){
            if(isset($_POST["delete_dni"])){
                $db_delete_dni = validar($_POST["delete_dni"]);
                $query = "DELETE FROM usuario WHERE dni = '$db_delete_dni'";
                try {
                    $usuarios_delete = $this->db_conexion->prepare($query);
                    $usuarios_delete->execute();
                } catch (PDOException $error) {
                    echo "ERROR ELIMINACION" . $error -> getMessage();
                }
            }
        }
        public function update_user(){
            if(isset($_POST['modify'])){
                $db_dni = validar($_POST["insert_dni"]);
                $db_name = validar($_POST["insert_name"]);
                $db_addres = validar($_POST["insert_addres"]);
                $db_direction = validar($_POST["insert_direction"]);
                $query = "UPDATE usuario SET dni = '$db_dni', nombre = '$db_name', apellido = '$db_addres', direccion = '$db_direction' WHERE dni = '$db_dni'";
                try {
                    $useuario_modify = $this -> db_conexion -> prepare($query);
                    $useuario_modify->execute();
                } catch (PDOException $error) {
                    echo "ERROR MODIFICACION" - $error -> getMessage();
                }
            }
        }
    }