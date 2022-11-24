<?php
include 'conexion_bd.php';


$codPedido = "";
$codProv = "";
$importeTotal = "";
$fecha = "";
$codProd = "";
$unidades = "";
$talla = "";
$nomT = "";
$nomProv = "";
$nomProd = "";
$imagen = "";
$precio = "";
echo '   <div>
            <h1 style="margin:10 px; text-align: center ; background-color: aqua"> OFFSIDE STORE</h1>
        </div>';
$q1 = " SELECT `codPedido`, `codProv`, `importeTotal`, `fecha` FROM `pedido` where aceptado=false";
$r1 = mysqli_query($conex, $q1) or die(mysql_error());
if (mysqli_num_rows($r1)==0) {
    echo 'No hay pedidos pendientes';
} else {




    while ($d = mysqli_fetch_array($r1)) {
        $codPedido = $d['codPedido'];
        $codProv = $d['codProv'];
        $fecha = $d['fecha'];
        $importeTotal = $d['importeTotal'];
        $query = "SELECT `nomProv` FROM `proveedores` WHERE codProv=$codProv";
        $r3 = mysqli_query($conex, $query) or die(mysql_error());

        while ($f = mysqli_fetch_array($r3)) {

            $nomProv = $f['nomProv'];
        }

        $q2 = " SELECT `codProd`, `unidades`, `talla` FROM `detallepedido` WHERE codPedido = $codPedido";
        $r2 = mysqli_query($conex, $q2) or die(mysql_error());


        while ($d2 = mysqli_fetch_array($r2)) {

            $codProd = $d2['codProd'];
            $unidades = $d2['unidades'];
            $talla = $d2['talla'];


            /* $query2 = "SELECT nomTalla from talla where idTalla = $talla ";
              $r3 = mysqli_query($conex, $query2) or die(mysql_error());

              while ($f1 = mysqli_fetch_array($r3)) {
              $nomT = $f1['nomTalla'];
              } */

            $query1 = "SELECT `pvp`, `nomProd`, `imagen` FROM `producto` WHERE codProd=$codProd";
            $r4 = mysqli_query($conex, $query1) or die(mysql_error());

            while ($f2 = mysqli_fetch_array($r4)) {

                $nomProd = $f2['nomProd'];
                $imagen = $f2['imagen'];
                $precio = $f2['pvp'];
            }

            echo' <hr> Codigo Pedido: ' . $codPedido . "<br>";
            echo'Nombre Proveedor: ' . $nomProv . "<br>";
            echo'Fecha:  ' . $fecha . "<br>";
            echo 'Producto: ' . $nomProd;
            echo'Talla: ' . $talla . "<br>";
            echo 'Unidades: ' . $unidades . ' * ' . 'Importe: ' . $precio . '-> Total: ' . $importeTotal . '€' . "<br>";
            echo '<img src="' . $imagen . '">' . "<br>";
        }

        echo '<form action="mostrarReabasteciminetoPedidos.php" method="post" >
                    <input type="hidden" name="codPedido" value="' . $codPedido . '">
                    <input type="submit" name="Aceptar" value="Aceptar">
                    </form>';

        echo '<form action="mostrarReabasteciminetoPedidos.php" method="post" >
                     <input type="hidden" name="codPedido" value="' . $codPedido . '">
                     <input type="submit" name="Rechazar" value="Rechazar">
                     </form>';
    }




    if (isset($_POST["Aceptar"])) {
        $codP = $_POST['codPedido'];
        $stockTotal = 0;
        /* Selecciono el pedido
          $query1 = "SELECT `codPedido` FROM `pedido` WHERE `codPedido`= $codP";
          $res1=mysqli_query($conex, $query1) or die (mysql_error());
          $var = mysqli_fetch_array($res1);
         */

        //Seleccionamos el codProd, unidades y stock de ese pedido
        $sql = "SELECT  `codProd`, `unidades`, `talla` FROM `detallepedido` WHERE `codPedido` = $codP";
        $res1 = mysqli_query($conex, $sql) or die(mysql_error());
        $var = mysqli_fetch_array($res1);
        $codProd = $var["codProd"];
        $ud = $var["unidades"];
        $talla = $var["talla"];


        //Seleccionamos el idTalla
        $sqlTalla = "SELECT idTalla FROM talla WHERE `nomTalla`='$talla'";
        $resTalla = mysqli_query($conex, $sqlTalla) or die(mysql_error());
        $varTalla = mysqli_fetch_array($resTalla);
        $idTalla = $varTalla["idTalla"];



        //Seleccionamos el stock del producto y talla pedido 
        $sql1 = "SELECT  codProd, stock FROM productotalla WHERE codProd = $codProd and idTalla=$idTalla";
        $res2 = mysqli_query($conex, $sql1) or die(mysql_error());
        $var2 = mysqli_fetch_array($res2);
        $stockActual = $var2["stock"];
        $codProdTalla = $var2["codProd"];

        $stockTotal = $stockActual + $ud;

        //Actualizar stock de dicho producto y talla
        
            $sql2 = "UPDATE `productotalla` SET `stock`=$stockTotal WHERE `codProd`=$codProd AND `idTalla`=$idTalla";
            $res3 = mysqli_query($conex, $sql2) or die(mysql_error());
        
        

        //Actualizar pedido a aceptado(1)
        $sql3 = "UPDATE `pedido` SET `aceptado`= true WHERE `codPedido`= $codP";
        $res4 = mysqli_query($conex, $sql3) or die(mysql_error());

        //Insertamos la factura
        $sql4 = "INSERT INTO `factura`( `codPedido`) VALUES ('$codP')";
        $res5 = mysqli_query($conex, $sql4) or die(mysql_error());


        if ($res3) {
            $ok = true;
            echo 'Insertado Correctamente';
            header('location:mostrarReabasteciminetoPedidos.php');
        } else {
            echo'Error al aceptar el pedido';
            $ok = false;
        }

        return $ok;
    }
    if (isset($_POST["Rechazar"])) {
        $ok = true;
        $codP = $_POST['codPedido'];

        $sql = "DELETE FROM `detallepedido` WHERE `codPedido` = $codP";
        $res = mysqli_query($conex, $sql) or die(mysql_error());

        $sql1 = "DELETE FROM `pedido` WHERE `codPedido` = $codP";
        $res3 = mysqli_query($conex, $sql1) or die(mysql_error());

        if ($res3) {
            $ok = true;
            echo 'Rechazado Correctamente';
            header('location:mostrarReabasteciminetoPedidos.php');
        } else {
            echo'Error al rechazar el pedido';
            $ok = false;
        }

        return $ok;
    }
}






/*
  include 'conexion_bd.php';


  $codPedido = "";
  $codProv = "";
  $importeTotal = "";
  $fecha = "";
  $codProd = "";
  $unidades = "";
  $talla = "";
  $nomT = "";
  $nomProv = "";
  $nomProd = "";
  $imagen = "";
  $precio = "";

  $q1 = " SELECT `codPedido`, `codProv`, `importeTotal`, `fecha` FROM `pedido` where aceptado=false";
  $r1 = mysqli_query($conex, $q1) or die(mysql_error());
  while ($d = mysqli_fetch_array($r1)) {
  $codPedido = $d['codPedido'];
  $codProv = $d['codProv'];
  $fecha = $d['fecha'];
  $importeTotal = $d['importeTotal'];
  $query = "SELECT `nomProv` FROM `proveedores` WHERE codProv=$codProv";
  $r3 = mysqli_query($conex, $query) or die(mysql_error());

  while ($f = mysqli_fetch_array($r3)) {

  $nomProv = $f['nomProv'];
  }

  $q2 = " SELECT `codProd`, `unidades`, `talla` FROM `detallepedido` WHERE codPedido = $codPedido";
  $r2 = mysqli_query($conex, $q2) or die(mysql_error());


  while ($d2 = mysqli_fetch_array($r2)) {

  $codProd = $d2['codProd'];
  $unidades = $d2['unidades'];
  $talla = $d2['talla'];


  /* $query2 = "SELECT nomTalla from talla where idTalla = $talla ";
  $r3 = mysqli_query($conex, $query2) or die(mysql_error());

  while ($f1 = mysqli_fetch_array($r3)) {
  $nomT = $f1['nomTalla'];
  }

  $query1 = "SELECT `pvp`, `nomProd`, `imagen` FROM `producto` WHERE codProd=$codProd";
  $r4 = mysqli_query($conex, $query1) or die(mysql_error());

  while ($f2 = mysqli_fetch_array($r4)) {

  $nomProd = $f2['nomProd'];
  $imagen = $f2['imagen'];
  $precio = $f2['pvp'];
  }

  echo' <hr> Codigo Pedido: ' . $codPedido . "<br>";
  echo'Nombre Proveedor: ' . $nomProv . "<br>";
  echo'Fecha:  ' . $fecha . "<br>";
  echo 'Producto: ' . $nomProd;
  echo'Talla: ' . $talla . "<br>";
  echo 'Unidades: ' . $unidades . ' * ' . 'Importe: ' . $precio . '-> Total: ' . $importeTotal . '€' . "<br>";
  echo '<img src="' . $imagen . '">' . "<br>";


  }

  echo ' <form action="mostrarReabasteciminetoPedidos.php" method="post" >';
  echo ' <input type="hidden" name="codPedido" value="'.$codPedido.'">
  <input type="submit" name="Aceptar" value="Aceptar">
  </form>';
  }




  if (isset($_POST["Aceptar"])) {
  $codP = $_POST['codPedido'];
  $ms="";
  $ms=$ms."//Se ha añadido el pedido: ".$codP;
  echo "$ms";
  }








  /*
  <form action="Catalogo.php" method="post" >
  <input type="hidden" name="nombre" value= "$nombre">
  <input type="hidden" name="codProd" value= "$codProd">
  <input type="hidden" name="imagen" value= "$foto">
  <input type="hidden" name="nomTalla" value= "$nomT">
  <input type="hidden" name="precio" value=  "$precio">
  <p>Talla: $select <p>
  <label >Unidades:</label> <input type="number" min="0" max="" name="unidades">
  <p><input type="submit" value="Añadir Carrito" name="botonCarrito"></p>
  </form>
  </div>

 */
?>

<html>
    <head>
        <title>title</title>
    </head>
    <body>


    </body>
</html>
