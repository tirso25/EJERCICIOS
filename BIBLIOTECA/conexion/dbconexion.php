<?php
    require_once "./config/dbconfig.php";

    class Conexdb{
        protected $db_conexion;
        function db_connect(){
            try {
                $this -> db_conexion = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
                $this -> db_conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Conexión Segura ";
            } catch (PDOException $error) {
                echo "ERROR DE CONEXIÓN CON LA BD" . $error -> getMessage();
            }
        }
    }