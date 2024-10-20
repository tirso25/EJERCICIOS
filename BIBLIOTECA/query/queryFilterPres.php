<?php
    include "./clases/Prestar.php";
    $contador = 0;
    function validar_entrada_filter_3($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $db_conexion = db_connect();
        $prestamos = [];
        $query = "";

        $db_dni_pre = validar_entrada_filter_3($_POST["filter_dni_pres"]);
        $db_cod_pres = validar_entrada_filter_3($_POST["filter_cod_pres"]);
        $db_fecha_pres = validar_entrada_filter_3($_POST["filter_addres"]);

        if(!empty($db_dni_pre) && $contador != 1){
            $query = "SELECT * FROM prestar WHERE DNI_USUARIO  LIKE '%' '$db_dni_pre' '%' LIMIT 0, 25";
    
            try {
                $resultado = $db_conexion->query($query);
                $prestamos = $resultado -> fetchAll(PDO::FETCH_CLASS, "Prestar");
            } catch (PDOException $error) {
                echo "ERROR FILTRADO" . $error->getMessage();
            }
            $contador = 1;
        }
        if(!empty($db_cod_pres) && $contador != 1){
            $query = "SELECT * FROM prestar WHERE CODIGO_LIBRO  LIKE '%' '$db_cod_pres' '%' LIMIT 0, 25";
    
            try {
                $resultado = $db_conexion->query($query);
                $prestamos = $resultado -> fetchAll(PDO::FETCH_CLASS, "Prestar");
            } catch (PDOException $error) {
                echo "ERROR FILTRADO" . $error->getMessage();
            }
            $contador = 1;
        }
        if(!empty($db_fecha_pres) && $contador != 1){
            $query = "SELECT * FROM Prestar WHERE FECHA_ENTREGA LIKE '%' '$db_fecha_pres' '%' LIMIT 0, 25";
    
            try {
                $resultado = $db_conexion->query($query);
                $prestamos = $resultado -> fetchAll(PDO::FETCH_CLASS, "Prestar");
            } catch (PDOException $error) {
                echo "ERROR FILTRADO" . $error->getMessage();
            }
            $contador = 1;
        }
    }
?>