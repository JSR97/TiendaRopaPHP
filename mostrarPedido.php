<?php

include 'conexion_bd.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd%22%3E

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title></title>
    </head>

    <body >
        <table>
            <tr>
                <td>Codigo de pedido</td>
                <td>Codigo de producto</td>
                <td>Importe</td>
                <td>Unidades</td>
            </tr>
            <?php
            $query="SELECT * FROM lineapedido";
            $res= mysqli_query($conex, $query) or die (mysql_error());
            while($mostrar= mysqli_fetch_array($res))
            {
            ?>
            <tr>
                <td><?php echo $mostrar['codPedido']?></td>
                <td><?php echo $mostrar['codProd']?></td>
                <td><?php echo $mostrar['importe']?></td>
                <td><?php echo $mostrar['unidades']?></td>
            </tr>
            <?php
            }
            ?>
        </table>

    </body>
</html>
