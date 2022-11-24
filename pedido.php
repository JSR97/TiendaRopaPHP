      
<?php
session_start();
include 'conexion_bd.php';


        $provedor = $_POST["provedor"];
        $nombreProd=$_POST["nombre"];
        $talla=$_POST["talla"];
        $img=$_POST["fichero"];
        $precio=$_POST["precio"];
        $unidades=$_POST["unidades"];   
        
    function validar($provedor,$nombreProd,$talla,$img,$precio,$unidades){
            $ok=true;
            $error="";
            if($provedor==0){
                $provedor=0;
                $error.="/ Seleccione provedor";
                $ok=false;
            }
            if($nombreProd==""){
                $nombreProd="";
                $error.="/ Introduzca nombre producto";
                $ok=false;
            }
            if($talla==0){
                $talla=0;
                $error.="/ Seleccione talla";
                $ok=false;
            }
             if($img==""){
                $img="";
                $error.="/ Introduzca imagen del producto";
                $ok=false;
            } if($precio<=0){
                $precio=0;
                $error.="/ Precio tiene que ser superior a 0";
                $ok=false;
            }
            if($unidades==0){
                $unidades=0;
                $error.="/ Unidades mayor a 0";
                $ok=false;
            }
            print $error;
            return $ok;
        }
        
        
function formulario($provedor,$nombreProd,$talla,$img,$precio,$unidades){
    $form1=<<<  FORM1
            <h1 style="margin:10 px; background-color: aqua"> OFFSIDE STORE</h1>

        <h2>Añadir Nuevo Producto al Catalogo: </h2>

    <form action="pedido.php" method="post">
        <label>Proveedor: </label>
        <select name="provedor" required>
        <option value="0">$provedor</option>
            
FORM1;
$select="";
        $query = "SELECT * from proveedores ";
        $res=mysqli_query($conex, $query) or die (mysql_error());
        while($prov = mysqli_fetch_array($res)){
            $codProv = $prov['codProv'];
            $nomProv = $prov['nomProv'];
            $select.="<option value='$codProv'> $nomProv </option>";
        }
        
$form2=<<<FORM2
        </select>
    <br><br>
    <label>Nombre del Producto: <input type="text" name="nombre">  </label>
    
     <br>
    <br> <label>Seleccionar Imagen: <input type="file" name="fichero"></label>
<br><br>
    <label>Tallas:</label>       
FORM2;



$selectTalla= "<select name='talla' required>
        <option value='0'>Seleccionar talla</option>";

    
    $query = "SELECT idTalla, nomTalla from talla";
    $r1=mysqli_query($conex, $query) or die (mysql_error());
    
    while ($f = mysqli_fetch_array($r1)){
        $idT=$f['idTalla'];
        $nomT =$f['nomTalla'];          
        $select.="<option value='$idT'>$nomT</option><br>";

   }
   
   $form3=<<<FORM3
           <br>
    <br>
        <label >Unidades:</label> <input type="number" min="0" name="unidades">
        <br><br>    <label >Importe:<input type="number" name="precio"> </label>
   <br> <br><input type="submit" value="Pedir Producto" name="pedido">

    </form>
FORM3;   
   
print $form1.$select.$form2.$selectTalla."</select>".$form3;


}

        
     /*   $query = "SELECT `nomProd` from `producto` WHERE `nomProd`='$nombreProd'";
        $res=mysqli_query($conex, $query) or die (mysql_error('Error Select'));
        $var = mysqli_fetch_array($res);
*/
           
function pedido($provedor,$nombreProd,$talla,$img,$precio,$unidades){
    //Registramos el pedido
        $query2 = "INSERT INTO `pedido`( `codProv`,`importeTotal`,`fecha`) VALUES ('$provedor','$unidades*$precio',CURRENT_DATE)";
        mysqli_query($conex, $query2) or die (mysql_error());
        
        
        
        
        
    
    
}
           if(isset($var['nomProd'])){
            $cantidad = $var['stock'];
            $nuevoStock = $cantidad+$unidades;
            $query1 = "UPDATE `producto` SET `stock`='$nuevoStock' WHERE `nomProd`='$nombre'";
            mysqli_query($conex, $query1) or die (mysql_error('Error update'));
            echo 'update ok';
           }else{
               $query="INSERT INTO `producto`( `talla`, `precio`, `stock`, `imagen`, `nomProd`)"
                       . " VALUES ('$talla','$precio','$unidades','$foto','$nombre')";
               mysqli_query($conex, $query) or die (mysql_error());
               
               echo 'Insert ok';               
        }
        

        
        $query3 = "SELECT `codPedido` FROM `pedido` WHERE `codPedido`= (SELECT MAX(codPedido) FROM pedidos)";
        $res2=mysqli_query($conex, $query3) or die (mysql_error());
        $var2 = mysqli_fetch_array($res2);
        
        $codPedido = $var2['codPedido'];
        
       
        $query6 = "SELECT `codProd` from `producto` WHERE `nomProd`='$nombre'";
        $res3=mysqli_query($conex, $query6) or die (mysql_error('Error Select'));
        $var3 = mysqli_fetch_array($res3);
        
        $codigoProducto = $var3['codProd'];
        
        $query4 = "INSERT INTO `lineapedido`(`codPedido`, `codProd`, `unidades`, `importe`)"
                    . " VALUES ('$codPedido','$codigoProducto','$unidades','$precio' * '$unidades')";
            mysqli_query($conex, $query4) or die (mysql_error());
           
            
        $query5 = "INSERT INTO `facturas`( `codPedido`, `fechaFact`, `importeFact`)"
                    . " VALUES ('$codPedido',CURRENT_DATE, '$precio' * '$unidades')";
           mysqli_query($conex, $query5) or die (mysql_error());
          
echo '<script language="JavaScript" type="text/JavaScript">var mensaje="PEDIDO REALIZADO";alert(mensaje);</script>';

            

        ?>




      
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Registrar Usuario</title>
    </head>

    <body>
   <?php 
        $nom=$_POST['prov'];
        $cuenta=$_POST['cuenta'];
    
        if (!validar($provedor,$nombreProd,$talla,$img,$precio,$unidades)){
            formulario($provedor,$nombreProd,$talla,$img,$precio,$unidades);
        }else{
            if(registrarP($nom, $cuenta)){
              //  print ("<script language='JavaScrip' type='text/JavaScript'>var mensaje='COMPRA REALIZADA';alert(mensaje);</script>'");
                header("location: cosasGerente.php");
            }
        }
?>

        </body>
</html>