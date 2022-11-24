<?php
//session_start();

$codProv = $_POST['provedor'];
$nomProd = $_POST['nomProd'];
$talla = $_POST['talla'];
$unidades = $_POST['unidades'];

//include 'conexion_bd.php';

echo $codProv;
        include 'conexion_bd.php';

$query = "SELECT * from productoprov WHERE `codProv`= $codProv and nomProd= $nomProd";
        $res=mysqli_query($conex, $query) or die (mysql_error());
       $nfila= mysqli_num_rows($res);
if($nfila>0){

for($i=0;$i<$nfila;$i++){
    $fila= mysqli_fetch_array($res);


$codProv = $fila['codProv'];
$talla = $fila['talla'];
$precio = $fila['precio'];
$stock = $fila['stock'];
$imagen = $fila['imagen'];
$nomProd= $fila['nomProd'];
$unidades = 0;

    if($stock>$unidades){
        $query2 = "INSERT INTO `pedidos`( `codProv`) VALUES ('$cod')";
        mysqli_query($conex, $query2) or die (mysql_error());
    }else{
        echo 'No hay Unidades suficientes';
    }
}
/*
$catalogo = <<< PRODUCTO

   
                    <p>$nomProd  </p>
                         <img src="$imagen">                    
                    <p>$precio €</p>
                    <p>Talla: $talla </p>    
                   <form method="post"  >  
                            <input type="hidden" name="nombre" value= "$nombre ">
                            <input type="hidden" name="codProd" value= "$codProd" >
                            <input type="hidden" name="imagen" value= "$foto" >
                            <input type="hidden" name="talla" value= "$talla" >
                            <input type="hidden" name="precio" value=  "$precio" >                            
                            <label >Unidades:</label> <input type="number" min="0" max=$stock name="unidades" value=  "$unidades" >
                            <p><input type="submit" value="Añadir Carrito" name="botonCarrito"></p>
        
                            
                        </form>
   
<?php } 
PRODUCTO;
        $cata =$cata.$catalogo; 
}
print $catalogo;
*/

}else{
    echo 'No existe Producto';
}


if(isset($_POST['botonCarrito'])){
    
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <title>title</title>
    </head>
    <body>
<?php $codProv ?>
    </body>
</html>
