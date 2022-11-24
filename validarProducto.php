<?php

        
        $nomProd = "";
        $precio = "";
        $stock = "";
        $imagen = "";

            $nomProd = $_POST["prod"];
            $precio= $_POST["precio"];
            $stock = $_POST["stock"];
            $imagen = $_POST["imagen"];
            if($_POST['talla']=="M"){      
                $talla = "M";
            }else if($_POST['talla']=="L"){      
                $talla = "L";
            }if($_POST['talla']=="XL"){      
                $talla = "XL";
            }
            
   
    
           
            
function validar (  $nomProd, $precio, &$stock, $imagen)
{

        $ok=true;
$error="";
    if ($nomProd=="")
    {    
        $nomProd="";
        $error=$error." / Nombre vacio";
        $ok=false;
    }else{
        $nomProd=trim($nomProd);
     $nomProd= addslashes($nomProd); 
    }
    if (($precio==""))
    {
        $precio="";
        $error=$error." / Precio incorrecto";
        $ok=false;
    }else{
        $precio=trim($precio);
     $precio= addslashes($precio); 
    }
    if($stock=""){
        $stock="";
        $error=$error." / Stock vacio";
        $ok=false;
    }else{
        $stock=trim($stock);
     $stock= addslashes($stock); 
    }
    if($imagen==""){
        $imagen="";
        $error = $error."/imagen vacia";
        $ok=false;
    }else{
       
        $imagen= "";     
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

<?php


include 'conexion_bd.php';

  if ( validar (  $nomProd, $precio, $stock, $imagen ))
   {           
       $imagen="imagenesTiendaRopa/".$imagen;
        $query="INSERT INTO producto( talla, precio, stock, imagen, nomProd) VALUES ('$talla','$precio','$stock','$imagen','$nomProd')";
	$res=mysqli_query($conex, $query) or die (mysqli_error($conex));
	if ($res)
	{
		echo ('Producto insertado correctamente');
                $insertado = true;
	}
	else
	{
		echo ('Problemas de Inserción');
                $insertado = false;
	}
        
      
   }
      ?>

    </body>
</html>

<?php
if(isset($_POST["IrCarrito"])){
    $_SESSION['usuario']=$user;
    header("location:carrito.php");
}

if(isset($_POST["botonCarrito"])){
$codProd=$_POST["codProd"];
$talla=$_POST["talla"];
$nomTalla=$_POST["nomTalla"];
$idtalla=$_POST["idtalla"];
$precio=$_POST["precio"];
$unidades=$_POST["unidades"];
$foto=$_POST["imagen"];
$nombre=$_POST["nombre"];
    
$_SESSION["carro"][$codProd]["codProd"]=$codProd;
$_SESSION["carro"][$codProd]["idtalla"]=$idtalla;
$_SESSION["carro"][$codProd]["talla"]=$talla;
$_SESSION["carro"][$codProd]["nomTalla"]=$nomTalla;
$_SESSION["carro"][$codProd]["precio"]=$precio;
$_SESSION["carro"][$codProd]["unidades"]=$unidades;
$_SESSION["carro"][$codProd]["imagen"]=$foto;
$_SESSION["carro"][$codProd]["nombre"]=$nombre;

}