<?php
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
            <form action="validarAltaProv.php" method="post">
                <p>
                    <label>Nombre Proveedor: </label> <input name="prov"  type="text" value="">
                </p>
                <p>
                    <label>Numero de cuenta: </label> <input name="cuenta" "type="text" maxlength="8" value="">
                </p>
                <p>
                    <input name="envio" type="submit" value="Registrar">
                </p>



            </form>
        </div>
    </body>
</html>