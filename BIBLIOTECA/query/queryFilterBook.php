<?php
    include "./clases/Libro.php";
    $contador = 0;
    function validar_entrada_filter_2($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $db_conexion = db_connect();
        $libros = [];
        $query = "";

        $db_titulo = validar_entrada_filter_2($_POST["filter_title"]);
        $db_autor = validar_entrada_filter_2($_POST["filtert_autor"]);

        if(!empty($db_titulo) && $contador != 1){
            $query = "SELECT * FROM libro WHERE TITULO LIKE '%' '$db_titulo' '%' LIMIT 0, 25";
    
            try {
                $resultado = $db_conexion->query($query);
                $libros = $resultado -> fetchAll(PDO::FETCH_CLASS, "libro");
            } catch (PDOException $error) {
                echo "ERROR FILTRADO" . $error->getMessage();
            }
            $contador = 1;
        }
        if(!empty($db_autor) && $contador != 1){
            $query = "SELECT * FROM libro WHERE AUTOR LIKE '%' '$db_autor' '%' LIMIT 0, 25";
    
            try {
                $resultado = $db_conexion->query($query);
                $libros = $resultado -> fetchAll(PDO::FETCH_CLASS, "libro");
            } catch (PDOException $error) {
                echo "ERROR FILTRADO" . $error->getMessage();
            }
            $contador = 1;
        }
    }
?>