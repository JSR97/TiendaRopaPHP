<?php

session_start();
if(empty($_SESSION)){
    $_SESSION['codU']=0;
}else{
    $user=$_SESSION['codU'];
}

//$enviar=$_SESSION["enviar"];
echo" Usuario normal : pepe 1234</br>";
echo" Usuario Gerente : Pedro 1234";
$cat=<<<CABECERA
        <div>
            <h1 style="margin:10 px; text-align: center ; background-color: aqua"> OFFSIDE STORE</h1>
        </div>
        <div   style="text-align: center; display: block ">
            <a style="margin: 25px" href="Index.php"><button type="button">Inicar Sesion</button></a>
         <a style="margin: 25px" href="Registrar.php"><button> Registrar </button></a>
         
         
CABECERA;
print $cat;
       
if(isset($user)){
    
           print "<form action='carrito.php' method='post'  >  
                            
                            <input type='hidden' name='usuario' value= '$user '>
                            <p><input type='submit' name='IrCarrito' value='Ir Carrito' ></p>
                            
                        </form></div>";  

}else{
     print "<a style='margin: 25px' href='carrito.php'><button disabled> IR a Carrito </button></a></div>";
}

//$cat =$cat.$irACarrito;

include 'conexion_bd.php';
$cata = " ";

$query = "SELECT DISTINCT  p.nomProd, p.codProd, p.pvp, p.imagen  FROM producto AS p JOIN productotalla AS t ON t.codProd=p.codProd AND t.stock>0";$res=mysqli_query($conex, $query) or die (mysql_error());
$nfila= mysqli_num_rows($res);
if($nfila>0){

for($i=0;$i<$nfila;$i++){
    $fila= mysqli_fetch_array($res);

$codProd = $fila['codProd'];
$precio = $fila['pvp'];
$nombre =$fila['nomProd'];
$foto= $fila['imagen'];

$unidades = 0;


$catalogo = <<< PRODUCTO
 
                <div style=" margin-left : 80px; margin-top:50px; float: left; border: black 2px solid; height: 300px; width: 250px; text-align: center; padding:30px " >

                    <p>$nombre  </p>
                         <img style="height: 100px; width: 100px;" src="$foto">   
                                     <img >

                    <p>$precio €</p>
PRODUCTO;

$q1=" SELECT idTalla, stock FROM productotalla where codProd= $codProd and stock > 0";
$r=mysqli_query($conex, $q1) or die (mysql_error());
$idT="";
$nomT="";
$unidades="";
$stock="";

$select= "<select name='talla' required>
        <option value='0'>Seleccionar talla</option>";

if (mysqli_num_rows($r)!=0){
    while($t= mysqli_fetch_array($r))
    {
        $idT=$t['idTalla'];
        $query = "SELECT nomTalla from talla where idTalla = $idT ";
        $r1=mysqli_query($conex, $query) or die (mysql_error());

        while ($f = mysqli_fetch_array($r1)){
            $nomT =$f['nomTalla'];          
            $select.="<option value='$idT'>$nomT-$idT</option><br>";
    
       }        
    }

}



$catalogo2 =<<< FORM
       <form action="Catalogo.php" method="post" >  
                <input type="hidden" name="nombre" value= "$nombre">
                <input type="hidden" name="codProd" value= "$codProd">
                <input type="hidden" name="imagen" value= "$foto">
                <input type="hidden" name="nomTalla" value= "$nomT">
                <input type="hidden" name="precio" value=  "$precio">   
                <p>Talla: $select <p></select><br>
                <label >Unidades:</label> <input type="number" min="0" max="" name="unidades">
                <p><input type="submit" value="Añadir Carrito" name="botonCarrito"></p>
        </form>
    </div>
        
 
FORM;


     
    $cata =$cata.$catalogo.$catalogo2; 
}


}
print $cata;
if(isset($_POST["IrCarrito"])){
    $_SESSION['usuario']=$user;
    header("location:carrito.php");
}

if(isset($_POST["botonCarrito"])){
    if($user==""){
    print 'ERROR PRIMERO DEBE INICIAR SESION';
    }
//$enviar=$_SESSION["enviar"];
//$_SESSION["enviar"]=$enviar++;
$codProd=$_POST["codProd"];
$talla=$_POST["talla"];
$nomTalla=$_POST["nomTalla"];
//$idtalla=$_POST["talla"];
$precio=$_POST["precio"];
$unidades=$_POST["unidades"];
$foto=$_POST["imagen"];
$nombre=$_POST["nombre"];

$sql="SELECT stock from productotalla where codProd=$codProd and idTalla=$talla";
$r =mysqli_query($conex, $sql) or die (mysql_error());
$filas= mysqli_fetch_array($r);
$stock=$filas['stock'];
if($stock<$unidades){
    echo 'no hay producto de esa talla';
}else{
    $_SESSION["carro"][$codProd]["codProd"]=$codProd;
$_SESSION["carro"][$codProd]["talla"]=$talla;
//$_SESSION["carro"][$codProd]["talla"]=$talla;
$_SESSION["carro"][$codProd]["nomTalla"]=$nomTalla;
$_SESSION["carro"][$codProd]["precio"]=$precio;
$_SESSION["carro"][$codProd]["unidades"]=$unidades;
$_SESSION["carro"][$codProd]["imagen"]=$foto;
$_SESSION["carro"][$codProd]["nombre"]=$nombre;
//$_SESSION["carro"][$codProd]["enviar"]=$enviar;
}

    



}

?>
