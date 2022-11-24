<?php
$gerente=<<<Gerente
        <br>
        <div>
            <h1 style="margin:10 px; text-align: center ; background-color: aqua"> OFFSIDE STORE</h1>
        </div>
          <br>
        <div   style="text-align: center; display: block ">
          <br>  <br>  <br>
            <a style="margin: 25px" href="altaProv.php"><button type="button" >Dar alta proveedores </button> </a>
          <br>  <br><br>
         <a style="margin: 25px" href="bajaProv.php"><button type="button" >Dar baja proveedores </button> </a>
          <br>  <br>
          <br>
         <a style="margin: 25px" href="addProducto.php"><button> Agregar Nuevo Producto</button></a>
          <br>  <br>
          <br><a style="margin: 25px" href="addStock.php"><button> Reabastecer Producto</button></a>
          <br>  <br>
         <br>
          <br><a style="margin: 25px" href="mostrarReabasteciminetoPedidos.php"><button>Ver Pedidos</button></a>
          <br>  <br>
          
          
          <br>
    </div>
Gerente;
 print $gerente;



?>


<?php
/*
session_start();
        include 'conexion_bd.php';

        
        if (empty($_POST)) {

            $nombreProv = "";
           
        } else {
          
            $nombreProv = $_POST["provedor"];
            
        }
    
           
            
function validar (  $nombreProv,  $error)
{

        $ok=true;

    
     if($nombreProv==""){
        $direccion="";
        $error=$error." / Proveedor vacio";
        $ok=false;
    }
        
     if ($error=="")
    {    
        $ok=true;
    }

     
    echo($error);
    return $ok;
    
     
}

?>
        
        
        
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Registrar Usuario</title>
</head>

<body>
    <h1>Lista de pedidos Proveedores: </h1>
    
    <form action="pedido.php" method="post">
        
        
        <select name="provedor" required>
        <option value="0">Selecione Proveedor:</option>
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
    
    <select name="producto" required>
        <option value="0">Selecione Producto:</option>
        <?php
         $query = "SELECT * from producto ";
        $res=mysqli_query($conex, $query) or die (mysql_error());
        while($producto = mysqli_fetch_array($res)){
            $codProd= $producto['codProd'];
            $nomProd = $producto['nomProd'];
            print("<option value='$codProd'> $nomProd</option>");

        }
        ?>
    </select>
    
    <label>Tallas:</label>
    <label><input type="radio" name="talla">M</label>
    <input type="radio" id="cbox2" name="talla"> <label >L</label>
    <input type="radio" id="cbox3"name="talla"> <label >XL</label>
    
    
    <input type="hidden" name="provedor" value= <?php $nomProv ?> >
    <input type="hidden" name="codProvedor" value= <?php $codProv ?> >
    <input type="hidden" name="producto" value= <?php $nomProd ?> >
    <input type="hidden" name="talla" value= "" >
    <input type="hidden" name="importe" value= <?php $importe ?> >
        <label >Unidades:</label> <input type="number" name="unidades" value=  <?php $unidades ?>>
        <label >Importe : <?php $importe ?> </label>
    <input type="submit" value="Pedir Producto" name="pedido">

    </form>
    
    

<?php

     /* if (empty($_POST)) //si aÃºn no se ha enviado el formulario
      {
          pintar_formulario_Registro( $codProv, $codProd, $talla,$unidades); 
          
      }
      else //para cada vez que el formulario se envÃ­e
      {
	//if (!validar_datos($nif, $nom, $email, $f_foto))
          $error="";
          if (!validar( $codProv, $codProd, $talla,$unidades, $error))
	{
              print("Errores: ".$error);
              pintar_formulario_Registro(  $usuario, $direccion,$contraseña, $email,$cuenta); 
    
	} else {	
            
$talla="";
$unidades=0;
            $_SESSION['codProv']= $codProv;
            $_SESSION['codProd']= $codProd;
            $_SESSION['talla']= $talla;
            $_SESSION['unidades']= $unidades;
            
         //   header("location: Catalogo.php");
                
            //}

           
	
	//}
*/
      ?>

    </body>
</html>
 