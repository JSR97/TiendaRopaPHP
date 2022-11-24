<?php
include 'conexion_bd.php';

session_start();

 $us= $_POST['usuario'];
 $carrito=$_SESSION["carro"];
 
 $total=0;
 $idtalla="";

 function idTalla($idT){
     include 'conexion_bd.php';

     $query = "SELECT nomTalla from talla where idTalla = $idT ";
        $r1=mysqli_query($conex, $query) or die (mysql_error());
        while ($f = mysqli_fetch_array($r1)){
            $nomT =$f['nomTalla'];  
    }
    return $nomT;
 }

if(isset($carrito)){
    foreach ($carrito as $key => $value) {
        echo "<hr>Producto: <strong>" .$key ."</strong><br>"; 
        echo "Nombre Producto: ".$value['nombre']."<br>";
        echo "<img src='".$value['imagen']."'>"."<br>";
        echo "Precio: ".$value['precio']."<br>";
        echo "Talla: ".idTalla($value['talla'])."<br>";
        echo "unidades: ".$value['unidades']."<br>";
        //echo "veces: ".$value['enviar']."<br>";
        $total+= $value["unidades"]*$value["precio"];
    }

    echo "<h2>El importe total es: $total</h2>";
     }else{
         echo 'Carrito Vacio';
     }
$boton = <<<BOTON
            <form action="" method="post">
        <input type='hidden' name='usuario' value= '$us'>
        
                <input type="submit" value="Comprar" name="compra">
        
             </form>
                <a href="Catalogo.php"><button>Regresar Catalogo</button> </a><br>

  
BOTON;  
      
     print $boton;
    if(isset($_POST["vaciar"])){
        session_destroy();
        header("location: Catalogo.php");
    }
    
    
    if(isset($_POST["compra"])){

        $prTotal=0;
              
       
        if(count($carrito)>0){
            //echo 'Cantidad'. count($carrito);
                          //insertamos en linea venta la venta

    
            

    foreach ($carrito as $key => $value) {
        //$cod = $value["codProd"];
        //echo "<hr>Producto: <strong>" .$key ."</strong><br>"; 
        //echo "<hr>Talla: <strong>" .$value["talla"] ."</strong><br>"; 
        
        $uni=$value['unidades'];
         $pr=$value['precio'];
            
            $prTotal+= $value["unidades"]*$value["precio"];
        
    }  
    
        $query4 = "INSERT INTO `venta`(`codUser`, `importeTotal`, `fecha`)"
                    . " VALUES ('$us','$prTotal', CURRENT_DATE)";
            mysqli_query($conex, $query4) or die (mysql_error());
        foreach ($carrito as $key => $value) {
            $unid=$value['unidades'];
            $idtalla=$value['talla'];
            //seleccionamos unidades para actualizar el stcok    $_SESSION["carro"][$codProd]["talla"]=$talla;
            $query = "SELECT stock from productotalla WHERE `codProd`= $key and `idTalla`=$idtalla";
            $res=mysqli_query($conex, $query) or die (mysql_error());
            $var = mysqli_fetch_array($res);

            for($i=0;$i<count($var);$i++){

               $cantidad = $var['stock'];
               $cantidad = $cantidad-$value['unidades'];

            }
        
        
        //actualizamos stock
        $query1 = "UPDATE `productotalla` SET `stock`='$cantidad' WHERE `codProd`=$key and `idTalla`=$idtalla";
        mysqli_query($conex, $query1) or die (mysql_error());
        
         //seleccionamos el codigo de la venta para la linea venta
        $query3 = "SELECT `codVenta` FROM `venta` WHERE `codVenta`= (SELECT MAX(codVenta) FROM venta)";
        $res2=mysqli_query($conex, $query3) or die (mysql_error());
        $var2 = mysqli_fetch_array($res2);
        
        $codVenta = $var2['codVenta'];
        
        $nomTalla="";
         $quer = "SELECT  nomTalla from talla where idTalla = $idtalla ";
        $r1=mysqli_query($conex, $quer) or die (mysql_error());
        while ($a= mysqli_fetch_array($r1)){
            $nomTalla=$a['nomTalla'];
        }
        
        //insertamos la venta en la tabla
        $query2 = "INSERT INTO `detalleventa`( `codVenta`,`codProd`,`unidades`,`talla`) VALUES ('$codVenta','$key',$unid,'$nomTalla')";
        mysqli_query($conex, $query2) or die (mysql_error());
           
           
    }

            
            
       
          
     $query5 = "INSERT INTO `ticket`( `codVenta`)"
                    . " VALUES ('$codVenta')";
           mysqli_query($conex, $query5) or die (mysql_error());
 
echo '<script language="JavaScript" type="text/JavaScript">var mensaje="COMPRA REALIZADA";alert(mensaje);</script>';
           
    }
}
       
   

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd%22%3E

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title></title>
    </head>

    <body  >
        <label ></label>
             <form action="carrito.php"method="post">
                 <br>
                  <input type="submit" value="Cerrar sesion" name="vaciar">
             </form>
   
        
       
           
    </body>
</html>
