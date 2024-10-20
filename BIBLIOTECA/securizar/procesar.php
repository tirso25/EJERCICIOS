<?php
    require_once "./query/queryUser.php";
    require_once "./query/queryBook.php";

    $error_name = $error_dni = $error_addres = $error_direction = $error_submit = $error_title = $error_autor = $error_dni_pres = $error_cod_pres = $error_date = "";
    $obligatorio = 0;
    $obligatorio2 = 0;
    $obligatorio3 = 0;
    $contador_elementos_obligatorios = 4;
    $contador_elementos_obligatorios2 = 2;
    $contador_elementos_obligatorios3 = 3;
    function validar($data){
        return htmlspecialchars(stripcslashes(trim($data)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["insert_submit"])){
            $insert_name = validar($_POST["insert_name"]);
            $insert_addres = validar($_POST["insert_addres"]);
            $insert_dni = validar($_POST["insert_dni"]);
            $insert_direction = validar($_POST["insert_direction"]);

            if(empty($insert_name)){
                $error_name = "NOMBRE OBLIGATORIO";
            } elseif(strlen($insert_name) > 20) {
                $error_name = "EL NOMBRE NO PUEDE SUPERAR LOS 20 CARACTERES";
            } elseif(!preg_match("/^[a-zA-Z-' ]*$/", $insert_name)){
                $error_name = "FORMATO DEL NOMBRE INCORRECTO";
            } else {
                $obligatorio++;
            }

            if(empty($insert_addres)){
                $error_addres = "APELLIDO OBLIGATORIO";
            } elseif(strlen($insert_addres) > 30) {
                $error_name = "EL APELLIDO NO PUEDE SUPERAR LOS 30 CARACTERES";
            } elseif(!preg_match("/^[a-zA-Z-' ]*$/", $insert_addres)){
                $error_addres = "FORMATO DEL APELLIDO INCORRECTO";
            } else {
                $obligatorio++;
            }

            if(empty($insert_dni)){
                $error_dni = "DNI OBLIGATORIO";
            } elseif (!preg_match("/^\d{8}[a-zA-Z]{1}$/", $insert_dni)) {
                $error_dni = "FORMATO DEL DNI INCORRECTO";
            } else {
                $obligatorio++;
            }

            if(empty($insert_direction)){
                $error_direction = "DIRECCION OBLIGATORIA";
            } elseif(strlen($insert_direction) > 40) {
                $error_name = "LA DIRECCION NO PUEDE SUPERAR LOS 40 CARACTERES";
            } elseif(!preg_match("/^[a-zA-Z0-9-' ]*$/", $insert_direction)){
                $error_direction = "FORMATO DIRECCION INCORRECTO";
            } else {
                $obligatorio++;
            }

            if(isset($_POST["insert_submit"]) && $obligatorio == $contador_elementos_obligatorios){
                $usuariodb = new Usuariodb();
                $insert_user = $usuariodb -> insert_user();
                echo
                '<script type="text/javascript">
                    alert("INFORMACION ENVIADA CON EXITO");
                    window.location.href="index.php";
                </script>';
            }
        }elseif(isset($_POST["insert_submit_libro"])){
            $insert_title = validar($_POST["insert_title"]);
            $insert_autor = validar($_POST["insert_autor"]);

            if(empty($insert_title)){
                $error_title = "TITULO OBLIGATORIO";
            } elseif(!preg_match("/^[a-zA-Z0-9-' ]*$/", $insert_title)){
                $error_title = "FORMATO TITULO INCORRECTO";
            } elseif(strlen($insert_title) > 40) {
                $error_title = "EL TITULO NO PUEDE SUPERAR LOS 40 CARACTERES";
            } else{
                $obligatorio2++;
            }

            if(empty($insert_autor)){
                $error_autor = "AUTOR OBLIGATORIO";
            } elseif(!preg_match("/^[a-zA-Z-' ]*$/", $insert_autor)){
                $error_autor = "FORMATO AUTOR INCORRECTO";
            } elseif(strlen($insert_autor) > 40) {
                $error_autor = "EL AUTOR NO PUEDE SUPERAR LOS 40 CARACTERES";
            } else{
                $obligatorio2++;
            }

            if(isset($_POST["insert_submit_libro"]) && $obligatorio2 == $contador_elementos_obligatorios2){
                $librodb = new Librodb();
                $insert_libro = $librodb -> insert_libro();
                echo
                '<script type="text/javascript">
                    alert("INFORMACION ENVIADA CON EXITO");
                    window.location.href="index.php";
                </script>';
            }
        }elseif(isset($_POST["insert_submit_pres"])){
            $insert_dni_pres = validar($_POST["insert_dni_pres"]);
            $insert_cod_pres = validar($_POST["insert_cod_pres"]);
            $insert_date = validar($_POST["insert_date"]);
            
            if(empty($insert_dni_pres)){
                $error_dni_pres = "DNI OBLIGATORIO";
            } elseif (!preg_match("/^\d{8}[a-zA-Z]{1}$/", $insert_dni_pres)) {
                $error_dni_pres = "FORMATO DEL DNI INCORRECTO";
            } else {
                $obligatorio3++;
            }

            if(empty($insert_cod_pres)){
                $error_cod_pres = "CODIGO OBLIGATORIO";
            } elseif (!preg_match("/^\d+$/", $insert_cod_pres)) {
                $error_cod_pres = "FORMATO DEL CODIGO INCORRECTO";
            } else {
                $obligatorio3++;
            }
            if(empty($insert_date)){
                $error_date_pres = "FEHCA ENTREGA OBLIGATORIA";
            }else{
                $obligatorio3++;
            }

            if(isset($_POST["insert_submit_pres"]) && $obligatorio3 == $contador_elementos_obligatorios3){
                include "./query/queryInsertPres.php";
                echo
                '<script type="text/javascript">
                    alert("INFORMACION ENVIADA CON EXITO");
                    window.location.href="index.php";
                </script>';
            }
        }
    }   