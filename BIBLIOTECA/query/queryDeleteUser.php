<?php
    function validar_entrada_delete_u($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $db_conexion = db_connect();
        $db_dni_delete = validar_entrada_delete_u($_POST["emp_no"]);
        $query = "DELETE FROM usuario WHERE DNI = ''$db_dni_delete''";

        try {
            $resultado = $db_conexion->prepare($query);
            $resultado->execute();
        } catch (PDOException $error) {
            echo "ERROR BORRADO " . $error->getMessage();
        }
    }
?>