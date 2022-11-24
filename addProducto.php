<?php
include 'conexion_bd.php';
session_start();
$pos = 0;
 $idProv ="";
      $nomProd="";
      $imagen="";
      $idTalla="";
      $numUnid="";
      $precio="";


    
function pintarFormPedidos($idProv, $nomProd, $imagen, $idTalla, $numUnid, $precio) {

    $formP = <<< PEDIDO
                <h1 style="margin:10 px; background-color: aqua"> OFFSIDE STORE</h1>

            <h2>Añadir Nuevo Producto al Catalogo: </h2>

            <form action="addProducto.php" method="post">

            <label>Proveedor: </label>
            <select name="provedor" required>
            <option value="0">Selecione Proveedor:</option>
PEDIDO;
    $select = "";
    include'conexion_bd.php';
    $query = "SELECT * from proveedores ";
    $res = mysqli_query($conex, $query) or die(mysql_error());
    while ($prov = mysqli_fetch_array($res)) {
        $codProv = $prov['codProv'];
        $nomProv = $prov['nomProv'];
        $select .= "<option value='$codProv'> $nomProv </option>";
    }

    $formP2 = <<< PE2
                </select>
                <br><br>
                <label>Nombre del Producto: <input type="text" name="nombre" value="$nomProd">  </label>

                 <br>
                <br> <label>Seleccionar Imagen: <input type="file" name="fichero" value="$imagen"></label>
            <br><br>
                <label>Tallas:</label>
PE2;




    $select1 = "<select name='talla' required>
        <option value='0'>Seleccionar talla</option>";


    $query1 = "SELECT idTalla, nomTalla from talla";
    $r1 = mysqli_query($conex, $query1) or die(mysql_error());

    while ($f = mysqli_fetch_array($r1)) {
        $idT = $f['idTalla'];
        $nomT = $f['nomTalla'];
        $select1 .= "<option value='$idT'>$nomT</option><br>";
    }

    $select1 .= "</select>";

    $formP3 = <<< PE3
        <br>
    <br>
        <label >Unidades:</label> <input type="number" min="0" name="unidades" value="$numUnid">
        <br><br>    <label >Importe:<input type="number" name="precio" value="$precio"> </label>
   <br> <br><input type="submit" value="Pedir Producto" name="pedido">
                     <input type="submit" value="Cerrar sesion" name="vaciar">

    </form>
PE3;
    print $formP . $select . $formP2 . $select1 . $formP3;
}

//FIN DE PINTAR FORMULARIO

function validarForm($idProv, $nomProd, $imagen, $idTalla, $numUnid, $precio) {
    $error = "";
    $correcto = true;

    if ($idProv == 0) {
        $idProv = 0;
        $error .= "/Seleccionar proovedor";
        $correcto = false;
    }
    if ($idTalla == 0) {
        $idTalla = 0;
        $error .= "/Seleccionar Talla";
        $correcto = false;
    }
    if ($nomProd == "") {
        $nomProd = "";
        $error .= "/Introducir nombre Producto vacio";
        $correcto = false;
    }/*
    if($nomProd!=""){
     include 'conexion_bd.php';
    $sql = "SELECT `nomProd` FROM `producto` WHERE nomProd = '$nomProd'";
    $res =mysqli_query($conex, $sql) or die (mysql_error());
    $error .="Nombre Repetido";
    $correcto = false;
    }*/
    
    if ($imagen == "") {
        $imagen = "";
        $error .= "/Seleccionar imagen";
        $correcto = false;
    }
    if ($numUnid == 0) {
        $numUnid = 0;
        $error .= "/Unidades > 0";
        $correcto = false;
    }
    if ($precio == 0) {
        $precio = 0;
        $error .= "/Precio > 0";
        $correcto = false;
    }
    print $error;
    return $correcto;
}

function pintarProd() {
    if (isset($c)) {
        foreach ($c as $key => $value) {
            echo "<hr>Producto: <strong>" . $key . "</strong><br>";
            echo "<hr>Prov:" . idProv($idProv['provedor']). "<br>";
            echo " nomTalla: " . $value['nomTalla'] . "<br>";
            echo "<img src='" . $value['imagen'] . "'>" . "<br>";
            echo "Precio: " . $value['precio'] . "<br>";
            echo "Talla: " . idTalla($value['talla']) . "<br>";
            echo "unidades: " . $value['unidades'] . "<br>";
            //echo "veces: ".$value['enviar']."<br>";
            $total += $value["unidades"] * $value["precio"];
            echo $total;
        }
    }
}

 function idTalla($idT){
     include 'conexion_bd.php';

     $query = "SELECT nomTalla from talla where idTalla = $idT ";
        $r1=mysqli_query($conex, $query) or die (mysql_error());
        while ($f = mysqli_fetch_array($r1)){
            $nomT =$f['nomTalla'];  
    }
    return $nomT;
 }
 function idProv($idProv){
     include 'conexion_bd.php';

     $query = "SELECT nomProv from proveedores where codProv = $idProv ";
        $r1=mysqli_query($conex, $query) or die (mysql_error());
        while ($f = mysqli_fetch_array($r1)){
            $nomT =$f['nomProv'];  
    }
    return $nomT;
 }

 
 function registrarNuevoProducto($idProv, $nomProd, $imagen, $idTalla, $numUnid, $precio){
     include 'conexion_bd.php';

    $precioTotal=0;
    $precioTotal=$numUnid*$precio;
    $ok=true;
    
    $query1 = "INSERT INTO `producto`( `pvp`, `nomProd`, `imagen`)"
             ." VALUES('$precio','$nomProd','$imagen') ";
    $res=mysqli_query($conex, $query1) or die (mysql_error());
    
    $qu = "SELECT `codProd` FROM `producto` WHERE `nomProd`= '$nomProd' ";
    $re=mysqli_query($conex, $qu) or die (mysql_error());
    $va = mysqli_fetch_array($re);
    $codProd = $va['codProd'];
    
    $qq="SELECT idTalla FROM talla";
    $ree=mysqli_query($conex, $qq) or die (mysql_error());
    while($t = mysqli_fetch_array($ree)){
        $ta=$t['idTalla'];
         $sql = "INSERT INTO `productotalla`(`idTalla`, `codProd`,`stock`) VALUES ($ta, $codProd,0);";
         mysqli_query($conex, $sql) or die (mysql_error());
    }
    
   
    
    
    $q = "SELECT `nomTalla` FROM `talla` WHERE `idTalla`= '$idTalla' ";
    $r=mysqli_query($conex, $q) or die (mysql_error());
    $va = mysqli_fetch_array($r);
    $nomTalla = $va['nomTalla'];

    
    
    $query = "INSERT INTO `pedido`( `codProv`, `importeTotal`, `fecha`, `aceptado`)"
                ." VALUES('$idProv','$precioTotal',CURRENT_DATE,'false') ";
    $res1=mysqli_query($conex, $query) or die (mysql_error());
    
    //seleccionamos el codigo de la venta para la linea venta
    $query3 = "SELECT `codPedido` FROM `pedido` WHERE `codPedido`= (SELECT MAX(codPedido) FROM pedido)";
    $res2=mysqli_query($conex, $query3) or die (mysql_error());
    $var2 = mysqli_fetch_array($res2);
    $codP = $var2['codPedido'];
        
    $query2 = "INSERT INTO `detallepedido`( `codPedido`,`codProd`,`unidades`,`talla`)"
              . " VALUES ('$codP','$codProd',$numUnid,'$nomTalla')";
    $res3=mysqli_query($conex, $query2) or die (mysql_error());

    if($res2){
      echo '<script language="JavaScript" type="text/JavaScript">var mensaje="PEDIDO REALIZADO";alert(mensaje);</script>';
       $ok=true;
    }else{
        echo 'Error en consultas sql';
        $ok=false;
    }
    return $ok;
 }
 
     if(isset($_POST["vaciar"])){
        session_destroy();
        header("location: Catalogo.php");
    }
    
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Registrar Usuario</title>
    </head>

    <body style="text-align: center " >


<?php
if (!isset($_POST['pedido'])) {
    pintarFormPedidos($idProv, $nomProd, $imagen, $idTalla, $numUnid, $precio);
} else {
    $imagen="imagenesTienda/";
    $idProv = $_POST['provedor'];
    $nomProd = $_POST['nombre'];
    $imagen .= $_POST['fichero'];
    $idTalla = $_POST['talla'];
    $numUnid = $_POST['unidades'];
    $precio = $_POST['precio'];


    if (!validarForm($idProv, $nomProd, $imagen, $idTalla, $numUnid, $precio)) {
        pintarFormPedidos($idProv, $nomProd, $imagen, $idTalla, $numUnid, $precio);
    } else {
        
        
        registrarNuevoProducto($idProv, $nomProd, $imagen, $idTalla, $numUnid, $precio);
        header("location:cosasGerente.php");
        
        
        
        
        
        
        
        
       /*
        $precioTotal=$precio*$numUnid;
        
        $query = "INSERT INTO `pedido`( `codProv`, `importeTotal`, `fecha`, `aceptado`)"
                ." VALUES('$idProv','$precioTotal',CURRENT_DATE,'false') ";
        $res=mysqli_query($conex, $query) or die (mysql_error());
        
        
        
        return $ok;
        
        
        
        
        $pos = $_SESSION['counter'];
        ++$_SESSION['counter'];
        
        
        //echo $pos;
            $detalles = array($idProv, $nomProd, $idTalla, $numUnid, $precio);
            $productos = array($detalles);
            
            
            foreach ($productos as $valu  ) {
             echo "Producto :".(string) $valu;
             foreach ($valu as $value) {
                 echo $valu."<hr>Prov:" .$value. "<br>";
                    echo " nombre: " . $value['nombre']. "<br>";
                    echo "<img src='" . $value. "'>" . "<br>";
                    echo "Precio: " . $value. "<br>";
                    echo "Talla: " . idTalla($value). "<br>";
                    echo "unidades: " . $value. "<br>";
                    //echo "veces: ".$value['enviar']."<br>";
                    $total += $value["unidades"] * $value["precio"];
                    echo $total;
            }}
            


    /*
      if(empty($_POST)){

      $idProv ="";
      $nomProd="";
      $imagen="";
      $idTalla="";
      $numUnid="";
      $precio="";
      $_SESSION["carroPedido"]="";

      }else{

      $idProv=$_POST['provedor'];
      $nomProd=$_POST['nombre'];
      $imagen=$_POST['fichero'];
      $idTalla=$_POST['talla'];
      $numUnid=$_POST['unidades'];
      $precio=$_POST['precio'];
      }
      //pintarFormPedidos($idProv, $nomProd, $imagen, $idTalla, $numUnid, $precio);

      if(!validarForm($idProv, $nomProd, $imagen, $idTalla, $numUnid, $precio)){
      pintarFormPedidos($idProv, $nomProd, $imagen, $idTalla, $numUnid, $precio);
      }
      else{


      // if button is pressed, increment counter


      if(isset($_POST["pedido"])){
      $pos = $_SESSION['counter'];
      ++$_SESSION['counter'];

      echo $pos;


      $talla=$_POST["provedor"];
      $nomTalla=$_POST["nombre"];
      $idtalla=$_POST["talla"];
      $precio=$_POST["precio"];
      $unidades=$_POST["unidades"];
      $foto=$_POST["fichero"];

      /*  for($i=0;$i<$pos;$i++){

      }
      $array=array(
      array($pos,$talla,$nomTalla,$idtalla,$precio,$unidades,$foto)
      );

      for($i=0;$i<count($array);$i++){
      for($a=0;$a<count($array[$i]);$a++){
      echo $a[$array[$i]];
      }
      }
      $_SESSION["carroPedido"][$pos]=$pos;

      $_SESSION["carroPedido"][$pos]["talla"]=$talla;
      $_SESSION["carroPedido"][$pos]["nomTalla"]=$nomTalla;
      $_SESSION["carroPedido"][$pos]["precio"]=$precio;
      $_SESSION["carroPedido"][$pos]["unidades"]=$unidades;
      $_SESSION["carroPedido"][$pos]["imagen"]=$foto;



      pintarFormPedidos($idProv=0, $nomProd="", $imagen="", $idTalla=0, $numUnid=0, $precio=0);
*/
      } 
}
?>
    </body>
</html>


