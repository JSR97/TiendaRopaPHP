<?php
include 'conexion_bd.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Documento sin t&iacute;tulo</title>
    </head>
    <body>
        <h1 style="margin:10 px; text-align: center ; background-color: aqua"> OFFSIDE STORE</h1>
        <div style=" margin-left: 450px; border: black 2px solid; height: 150px; width: 250px; text-align: center; padding:30px ">
            <form action="validarBajaProv.php" method="post">
                      <select name="provedor" required>
            <option>Selecione Proveedor:</option>
            <?php
             $query = "SELECT * from proveedores ";
            $res=mysqli_query($conex, $query) or die (mysql_error());
            while($prov = mysqli_fetch_array($res)){
                $codProv = $prov['codProv'];
                $nomProv = $prov['nomProv'];
                print("<option value='$codProv'> $nomProv </option>");
            }

            ?>
        </select>
                <p>
                    <input name="envio" type="submit" value="Eliminar">
                </p>



            </form>
        </div>
    </body>
</html>