<?php
    $idProd=$_POST['prod'];
    $idProv=$_POST['provedor'];
    $idTalla=$_POST['talla'];
    $ud=$_POST['uni'];
    $nomT="";

    
    function registrarPedido($idProd,$idProv,$idTalla,$ud){
        include 'conexion_bd.php';
        $precioTotal=0;
        $ok=false;
        $precio= "SELECT pvp FROM producto WHERE codProd= $idProd";
        $r= mysqli_query($conex, $precio);
        
        while($fila = mysqli_fetch_array($r)){
            $pvp= $fila['pvp'];
        }
        
        $precioTotal=$pvp*$ud;
        
        $query = "INSERT INTO `pedido`( `codProv`, `importeTotal`, `fecha`, `aceptado`)"
                ." VALUES('$idProv','$precioTotal',CURRENT_DATE,'false') ";
        $res=mysqli_query($conex, $query) or die (mysql_error());
        
           //seleccionamos el codigo de la venta para la linea venta
        $query3 = "SELECT `codPedido` FROM `pedido` WHERE `codPedido`= (SELECT MAX(codPedido) FROM pedido)";
        $res2=mysqli_query($conex, $query3) or die (mysql_error());
        $var2 = mysqli_fetch_array($res2);
        
        
        $query = "SELECT nomTalla from talla where idTalla = $idTalla ";
        $r1=mysqli_query($conex, $query) or die (mysql_error());

        while ($f = mysqli_fetch_array($r1)){
            $nomT =$f['nomTalla'];          
        }
        $codP = $var2['codPedido'];
        
          $query2 = "INSERT INTO `detallepedido`( `codPedido`,`codProd`,`unidades`,`talla`)"
                  . " VALUES ('$codP','$idProd',$ud,'$nomT')";
        mysqli_query($conex, $query2) or die (mysql_error());

        if($res2){
          echo '<script language="JavaScript" type="text/JavaScript">var mensaje="PEDIDO REALIZADO";alert(mensaje);</script>';
           $ok=true;
        }else{
            echo 'Error en consultas sql';
            $ok=false;
        }
        return $ok;
        
    }
    function validarPedido($idProd,$idProv,$idTalla,$ud){
        $ok=true;
        $error="";
        if($idProd==0){
            $idProd=0;
            $error.= "/No ha seleccionado Producto";
            $ok=false;
        }
        if($idProv==0){
            $idProv=0;
            $error.= "/No ha selccinado Proveedor";
            $ok=false;
        }
        if($idTalla==0){
            $idTalla=0;
            $error.= "/No ha selccionado Talla";
            $ok=false;
        }
        
        if($ud==0){
            $ud=0;
            $error.="/No ha seleccionado unidades";
            $ok=false;
        }
        
        print $error;
        return $ok;
    }
    
    function pintarFormularioPedido($idProd,$idProv,$idTalla,$ud){
        $form =<<< FORM
                <h1 style='margin:10 px; text-align: center ; background-color: aqua'> OFFSIDE STORE</h1>
                <div style=' margin-left: 450px; border: black 2px solid; height: 150px; width: 250px; text-align: center; padding:30px '>
            <form action='validar_registrarProd.php' method='post'>
            <select name='prod' required>
            <option>Selecione Producto</option>
FORM;
    
        
        
        include 'conexion_bd.php';
            $p="";
     
            $query = "SELECT * from producto ";
            $res=mysqli_query($conex, $query) or die (mysql_error());
            while($prod = mysqli_fetch_array($res)){
                $codProd = $prod['codProd'];
                $nomProd = $prod['nomProd'];
                $p.="<option value='$codProd'> $nomProd </option>";
               
            }
            $form2 =<<<FORM2
                    </select><br>
                <br><select name='provedor' required>
            <option>Selecione Proveedor</option>
                
FORM2;
            
            
        include 'conexion_bd.php';
            $prov="";
     
            $query = "SELECT * from proveedores ";
            $r=mysqli_query($conex, $query) or die (mysql_error());
            while($pr = mysqli_fetch_array($r)){
                $codProv = $pr['codProv'];
                $nomProv = $pr['nomProv'];
                $prov.="<option value='$codProv'> $nomProv </option>";
                
            }
            $form3= <<<FORM3
                </select>
                     <br>
                    <br><select name='talla' required>
                <option>Selecione Talla</option>
FORM3;
        include 'conexion_bd.php';
            $t="";
     
            $query = "SELECT * from talla ";
            $talla=mysqli_query($conex, $query) or die (mysql_error());
            while($pr = mysqli_fetch_array($talla)){
                $codtalla = $pr['idTalla'];
                $nomtalla = $pr['nomTalla'];
                $t.="<option value='$codtalla'> $nomtalla </option>";
                
            }
            $form4=<<<FORM4
                    </select>
                <br>
                <br>Unidades: <input name="uni" type="number"  min="1" placeholder="Unidades > 1" value="$ud">
                <p>
                    <input name="envio" type="submit" value="Añadir">
                </p>



            </form>
        </div>
FORM4;
            print $form.$p.$form2.$prov.$form3.$t.$form4;
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Añadir Productos</title>
</head>
<body>
    
    
    <?php 

        if (!validarPedido($idProd, $idProv, $idTalla, $ud)){
            echo 'No he validado';
            pintarFormularioPedido($idProd, $idProv, $idTalla, $ud);
        }else{
            registrarPedido($idProd, $idProv, $idTalla, $ud);
        header('location:cosasGerente.php');

        }
?>
</body>
</html>