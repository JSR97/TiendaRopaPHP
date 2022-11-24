<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Documento sin t&iacute;tulo</title>
</head>
<body>
    <h1>Consultar el numero de pedidos a un proveedor determinado</h1>
    <form method="post" action="" name="form_consulta_pedidos">
    <select name="provedor" required>
        <option>Selecione Proveedor:</option>
        <?php
        include "conexion_bd.php";
        $query = "SELECT nomProv, codProv FROM proveedores";
        $res= mysqli_query($conex, $query) or die(mysqli_error($conex));
        while($reg= mysqli_fetch_array($res))
        {
            $nombreProv = $reg['nomProv'];
            $codigoProv = $reg['codProv'];
            print("<option value='$codigoProv'> $nombreProv </option>");
        }

        ?>
    </select>
        <input type="submit" name="datos" value="enviar">
    </form>



    <?php

    if(isset($_POST['datos'])){
        $codigoProv = $_POST['provedor'];

        $query2 = "SELECT * from pedidos WHERE codProv='$codigoProv'";
        $res2=mysqli_query($conex, $query2) or die (mysql_error());
        $result = mysqli_fetch_array($res2);
        echo 'Numero de pedidos al proveedor:'. count($result).'<br>';

    }

    ?>
</body>
</html>