<?php
include 'conexion_bd.php';
if(empty($_POST)){
    $nom = 0;
} else {
    $nom=$_POST['prod'];
}
    function pintarFormBajaProd(){
        include 'conexion_bd.php';
        $prov="<h1 style='margin:10 px; text-align: center ; background-color: aqua'> OFFSIDE STORE</h1>
        
            <div style=' margin-left: 450px; border: black 2px solid; height: 150px; width: 250px; text-align: center; padding:30px '>
            <form action='bajaProducto.php' method='post'>
                      <select name='prod' required>
            <option>Selecione Proveedor:</option>";
     
            $query = "SELECT * from producto";
            $res=mysqli_query($conex, $query) or die (mysql_error());
            while($prov = mysqli_fetch_array($res)){
                $codProd = $prov['codProd'];
                $nomProd = $prov['nomProd'];
                $prov.="<option value='$codProd'> $nomProd </option>";
            }

            
    $form =<<<Form
       
            
        </select>
                <p>
                    <input name="envio" type="submit" value="Eliminar">
                </p>



            </form>
        </div>
Form;     
    print $prov.$form;
}


    function eliminar($nom){
        include 'conexion_bd.php';
        $ok=false;
        $query = "DELETE FROM `productotalla` WHERE codProd = $nom ";
        $r=mysqli_query($conex, $query) or die (mysql_error());
        while ($r){
            
        }
        $query = "DELETE FROM `producto` WHERE codProd = $nom ";
        $res=mysqli_query($conex, $query) or die (mysql_error());
        if($res){
            $ok = true;
        } else {
            $ok=false;
        }
        
        return $ok;
    }
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Eliminar Producto</title>
</head>
    <body>
        
        <?php
            
            if(isset($_POST['envio'])){
                pintarFormBajaProd();
            } else {
                $nom=$_POST["prod"];
                eliminar($nom);
            }
        
            
        ?>
    </body>
</html>