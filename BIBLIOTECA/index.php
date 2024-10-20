<?php
    require_once "./conexion/dbconexion.php";
    require_once "./securizar/procesar.php";
    require_once "./query/queryUser.php";
    require_once "./query/queryBook.php";

    $usuariodb = new Usuariodb();
    $boton = "insert_submit";
    $mensaje = "FORMULARIO INSERCION USUARIO";
    $cruUsers = $usuariodb -> select_usuario();
    $usuariosFILTRO = $usuariodb -> filter_user();
    if(isset($_POST["delete_user"])){
        $usuariodb -> delete_user();
    }
    if(isset($_POST['modify_user'])){
        echo "TEST";
        $userModi = $usuariodb -> getUser();
        extract($userModi);
            $mensaje = "FORMULARIO MODIFICACION USUARIO";
            $boton = "modify";
    }
    if(isset($_POST['modify'])){
        echo "ACTUALIZA";
        $usuariodb -> update_user();
        $boton = "insert_submit";
        $mensaje = "FORMULARIO INSERCION USUARIO";
    }

    $librodb = new Librodb();
    $libroCRUD = $librodb -> select_libro();
    $librosFILTRO = $librodb -> filter_book();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
        //! NO ENTIENDO EL $dni / $nombre / $apllido / $direccion
        
        //! NO ENTIENDON PO QUE SI MODIFICO O ELIMINO NO SE CAMBIA EL toTable HASTA QUE REINICIE EL NAVEGADOR, MIENTRAS QUE EL $boto o $mensaje SI SE CAMBIA SIN NECESIDAD DE REINICIAR EL NAVEGADOR
    ?>
    <CENTER>
        <!-- VER TABLA USUARIOS -->
        <fieldset>
            <legend>
                <h1>CRUD USER</h1>
            </legend>
            <table border="1" class="tabla">
                <tr>
                    <th colspan="6">CONTENIDO TABLA USUARIO</th>
                </tr>
                <tr>
                    <th>DNI</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>DIRECCION</th>
                    <th>ELIMINAR</th>
                    <th>MODIFICAR</th>
                </tr>
                <?php if(!empty($cruUsers)):?>
                    <?php foreach($cruUsers as $usr):?>
                        <!-- <?php var_dump($usr);?> -->
                        <tr>
                            <?=$usr->toTable();?>
                            <td>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                    <input type="hidden" name="delete_dni" value="<?php echo $usr->getDni(); ?>">
                                    <input type="submit" name="delete_user" value="EIMINAR" class="boton2">
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                    <input type="hidden" name="modify_dni" value="<?php echo $usr->getDni(); ?>">
                                    <input type="submit" name="modify_user" value="MODIFICAR" class="boton3">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach?>
                <?php endif;?>
            </table>
            <!-- FORMULARIO INSERCION USUARIOS-->
            <fieldset>
                <legend>
                    <h1><?=$mensaje?></h1>
                </legend>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <table>
                        <tr>
                            <th><label for="insert_dni">DNI : </label></th>
                            <th>
                                <input type="text" name="insert_dni" placeholder="INSERTA DNI"
                                    value="<?php if (isset($_POST['modify_user'])) { echo htmlspecialchars($dni); } else { echo htmlspecialchars(isset($insert_direction) ? $insert_direction : ''); } ?>"
                                    required>
                            </th>
                            <th>
                                <span class="error">
                                    <p>*</p>
                            <th><?php echo $error_dni;?></th>
                            </span>
                        </tr>
                        <tr>
                            <th><label for="insert_name">NOMBRE : </label></th>
                            <th><input type="text" name="insert_name" placeholder="INSERTA NOMBRE"
                                    value="<?php if (isset($_POST['modify_user'])) { echo htmlspecialchars($nombre); } else {echo htmlspecialchars(isset($insert_name) ? $insert_name : ""); } ?>"
                                    required></th>
                            <th>
                                <span class="error">
                                    <p>*</p>
                            <th><?php echo $error_name;?></th>
                            </span>
                        </tr>
                        <tr>
                            <th><label for="insert_addres">APELLIDOS : </label></th>
                            <th><input type="text" name="insert_addres" placeholder="INSERTA APELLIDOS"
                                    value="<?php if (isset($_POST['modify_user'])) { echo htmlspecialchars($apellido); } else {echo htmlspecialchars(isset($insert_addres) ? $insert_addres : ""); }?>"
                                    required>
                            </th>
                            <th>
                                <span class="error">
                                    <p>*</p>
                            <th><?php echo $error_addres;?></th>
                            </span>
                        </tr>
                        <tr>
                            <th><label for="insert_direction">DIRECCION : </label></th>
                            <th><input type="text" name="insert_direction" placeholder="INSERTA DIRECCION"
                                    value="<?php if (isset($_POST['modify_user'])) { echo htmlspecialchars($direccion); } else {echo htmlspecialchars(isset($insert_direction) ? $insert_direction : ""); }?>"
                                    required>
                            </th>
                            <th>
                                <span class="error">
                                    <p>*</p>
                            <th><?php echo $error_direction;?></th>
                            </span>
                        </tr>
                    </table>
                    <input type="submit" name="<?=$boton?>" value="ENVIAR" class="boton">
                </form>
            </fieldset>
            <!-- FORMULARIO FILTRO USUARIOS -->
            <fieldset>
                <legend>
                    <h1>FORMULARIO FILTRAR USUARIO</h1>
                </legend>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <table>
                        <tr>
                            <th><label for="filter_dni">DNI : </label></th>
                            <th><input type="text" name="filter_dni" placeholder="INSERTA DNI"></th>
                        </tr>
                        <tr>
                            <th><label for="filter_name">NOMBRE : </label></th>
                            <th><input type="text" name="filter_name" placeholder="INSERTA NOMBRE"></th>
                        </tr>
                        <tr>
                            <th><label for="filter_addres">APELLIDOS : </label></th>
                            <th><input type="text" name="filter_addres" placeholder="INSERTA APELLIDOS"></th>
                        </tr>
                        <tr>
                            <th><label for="filter_direccion">DIRECCION : </label></th>
                            <th><input type="text" name="filter_direccion" placeholder="INSERTA DIRECCION"></th>
                        </tr>
                    </table>
                    <input type="submit" name="filter_submit" value="FILTRAR" class="boton">
                </form>
                <?php if(!empty($_POST["filter_submit"])):?>
                <table border="1" class="tabla">
                    <tr>
                        <th colspan="4">RESULTADO FILTRADO</th>
                    </tr>
                    <tr>
                        <th>DNI</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>DIRECCION</th>
                        <th>ELIMINAR</th>
                        <th>MODIFICAR</th>
                    </tr>
                    <?php if(!empty($usuariosFILTRO)):?>
                        <?php foreach($usuariosFILTRO as $usr):?>
                            <tr>
                                <?=$usr->toTable();?>
                                <td>
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                                        <input type="hidden" name="delete_dni" value="<?php echo $usr->getDni();?>">
                                        <input type="submit" name="delete_user" value="Eliminar" class="boton2">
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                                        <input type="hidden" name="modify_dni" value="<?php echo $usr->getDni();?>">
                                        <input type="submit" name="modify_user" value="Modificar" class="boton3">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach?>
                    <?php endif;?>
                </table>
                <?php endif;?>
            </fieldset>
        </fieldset>
        <hr>
        <!-- VER TABLA LIBROS -->
        <fieldset>
            <legend>
                <h1>CRUD LIBRO</h1>
            </legend>
            <table border="1" class="tabla">
                <th colspan="5">CONTENIDO TABLA LIBRO</th>
                <tr>
                    <th>CODIGO</th>
                    <th>TITULO</th>
                    <th>AUTOR</th>
                    <th>ELIMINAR</th>
                    <th>MODIFICAR</th>
                </tr>
                <?php if(!empty($libroCRUD)):?>
                    <?php foreach($libroCRUD as $lib):?>
                        <tr>
                            <?=$lib->toTable()?>
                            <td>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                                    <input type="hidden" name="delete_cod" value="<?php echo $lib->getCodigo()?>">
                                    <input type="submit" name="delete_book" value="EIMINAR" class="boton2">
                                </form>
                            </td>
                            <td>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                                    <input type="hidden" name="modify_cod" value="<?php echo $lib->getCodigo()?>">
                                    <input type="submit" name="modify_user" value="MODIFICAR" class="boton3">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
            </table>
        </fieldset>
        <fieldset>
            <legend>
                <h1>FORMULARIO INSERCION LIBRO</h1>
            </legend>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <table>
                    <tr>
                        <th><label for="insert_title">TITULO :</label></th>
                        <th><input type="text" name="insert_title" placeholder="INSERTA TITULO"
                                value="<?php echo htmlspecialchars(isset($insert_title) ? $insert_title : "")?>"
                                required></th>
                        <th><span class="error">*</span><?php echo $error_title;?></th>
                    </tr>
                    <tr>
                        <th><label for="insert_autor">AUTOR :</label></th>
                        <th><input type="text" name="insert_autor" placeholder="INSERTA AUTOR"
                                value="<?php echo htmlspecialchars(isset($insert_autor) ? $insert_autor : "")?>"
                                required></th>
                        <th><span class="error">*</span><?php echo $error_autor;?></th>
                    </tr>
                </table>
                <input type="submit" name="insert_submit_libro" value="ENVIAR" class="boton">
            </form>
        </fieldset>
        <fieldset>
            <legend>
                <h1>FORMULARIO FILTRAR LIBRO</h1>
            </legend>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <table>
                    <tr>
                        <th><label for="filter_cod" name="filter_cod">CODIGO :</label></th>
                        <th><input type="text" name="filter_cod" placeholder="INSERTA CODIGO"></th>
                    </tr>
                    <tr>
                        <th><label for="filter_title">TITULO :</label></th>
                        <th><input type="text" name="filter_title" placeholder="INSERTA TITULO"></th>
                    </tr>
                    <tr>
                        <th><label for="filtert_autor">AUTOR :</label></th>
                        <th><input type="text" name="filtert_autor" placeholder="INSERTA AUTOR"></th>
                    </tr>
                </table>
                <input type="submit" name="filter_submit_libro" value="FILTRAR" class="boton">
            </form>
            <?php if(!empty($_POST["filter_submit_libro"])):?>
            <table border="1" class="tabla">
                <tr>
                    <th colspan="3">RESULTADO FILTRADO</th>
                </tr>
                <tr>
                    <th>CODIGO</th>
                    <th>TIRULO</th>
                    <th>AUTOR</th>
                </tr>
                <?php if(!empty($librosFILTRO)): ?>
                    <?php foreach($librosFILTRO as $lib): ?>
                        <tr>
                            <?= $lib->toTable(); ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
            <?php endif;?>
        </fieldset>
        <hr>
        <fieldset>
            <legend>
                <h1>FORMULARIO INSERCION PRESTAMO</h1>
            </legend>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <table>
                    <tr>
                        <th><label for="insert_dni_pres">DNI : </label></th>
                        <th>
                            <input type="text" name="insert_dni_pres" placeholder="INSERTA DNI"
                                value="<?php echo htmlspecialchars(isset($insert_dni_pres) ? $insert_dni_pres : ""); ?>"
                                required>
                        </th>
                        <th>
                            <span class="error">
                                <p>*</p>
                        <th><?php echo $error_dni_pres;?></th>
                        </span>
                    </tr>
                    </th>
                    </tr>
                    <tr>
                        <th><label for="insert_cod_pres">CODIGO : </label></th>
                        <th><input type="number" name="insert_cod_pres" placeholder="INSERTA CODIGO"
                                value="<?php echo htmlspecialchars(isset($insert_cod_pres) ? $insert_cod_pres : ""); ?>"
                                required></th>
                        <th>
                            <span class="error">
                                <p>*</p>
                        <th><?php echo $error_cod_pres;?></th>
                        </span>
                    </tr>
                    </th>
                    </tr>
                    <tr>
                        <th><label for="insert_date">FECHA ENTREGA : </label></th>
                        <th><input type="date" name="insert_date" placeholder="INSERTA FECHA ENTREGA"
                                value="<?php echo htmlspecialchars(isset($insert_date) ? $insert_date : ""); ?>"
                                required>
                        </th>
                        <th>
                            <span class="error">
                                <p>*</p>
                        <th><?php echo $error_date;?></th>
                        </span>
                    </tr>
                </table>
                <input type="submit" name="insert_submit_pres" value="ENVIAR" class="boton">
            </form>
        </fieldset>
        <fieldset>
            <legend>
                <h1>FORMULARIO FILTRAR PRESTAMO</h1>
            </legend>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <table>
                    <tr>
                        <th><label for="filter_dni_pres">DNI : </label></th>
                        <th><input type="text" name="filter_dni_pres" placeholder="INSERTA DNI"></th>
                    </tr>
                    <tr>
                        <th><label for="filter_cod_pres">CODIGO : </label></th>
                        <th><input type="number" name="filter_cod_pres" placeholder="INSERTA CODIGO"></th>
                    </tr>
                    <tr>
                        <th><label for="filter_addres">FECHA : </label></th>
                        <th><input type="date" name="filter_addres" placeholder="INSERTA FECHA ENTREGA"></th>
                    </tr>
                </table>
                <input type="submit" name="filter_submit_pres" value="FILTRAR" class="boton">
            </form>
            <?php if(!empty($_POST["filter_submit_pres"])):?>
            <table border="1" class="tabla">
                <tr>
                    <th colspan="3">RESULTADO FILTRADO</th>
                </tr>
                <tr>
                    <th>DNI</th>
                    <th>CODIGO</th>
                    <th>FECHA</th>
                </tr>
                <?php if(!empty($prestamos)): ?>
                <?php foreach($prestamos as $i): ?>
                <tr>
                    <?= $i->toTable(); ?>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </table>
            <?php endif;?>
        </fieldset>
        <hr>
    </CENTER>
</body>

</html>