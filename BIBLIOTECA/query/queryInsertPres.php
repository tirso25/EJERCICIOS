<?php
    function validar_entrada_pres($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $db_conexion = db_connect();

        $db_dni_pres = validar($_POST["insert_dni_pres"]);
        $db_cod_pres = validar($_POST["insert_cod_pres"]);
        $db_date = validar($_POST["insert_date"]);

        $query = "INSERT INTO prestar VALUES ('$db_dni_pres', '$db_cod_pres', '$db_date')";
        try {
            $resultado = $db_conexion->query($query);
        } catch (PDOException $error) {
            echo "ERROR INSERCION". $error->getMessage();
        }
    }
?>