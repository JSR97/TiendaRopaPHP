
<html>

<head>
<title>AÃ±adir Stock Producto</title>
</head>
    <body>
        <h1 style='margin:10 px; text-align: center ; background-color: aqua'> OFFSIDE STORE</h1>
        <div style=' margin-left: 450px; border: black 2px solid; height: 150px; width: 250px; text-align: center; padding:30px '>
            <form action='validar_registrarProd.php' method='post'>
            <select name='prod' required>
            <option>Selecione Producto</option>
        <?php
        include 'conexion_bd.php';
            $p="";
     
            $query = "SELECT * from producto ";
            $res=mysqli_query($conex, $query) or die (mysql_error());
            while($prod = mysqli_fetch_array($res)){
                $codProd = $prod['codProd'];
                $nomProd = $prod['nomProd'];
                $p.="<option value='$codProd'> $nomProd </option>";
               
            }
            print $p;
            ?>
            </select><br>
                <br><select name='provedor' required>
            <option>Selecione Proveedor</option>
                <?php
        include 'conexion_bd.php';
            $prov="";
     
            $query = "SELECT * from proveedores ";
            $r=mysqli_query($conex, $query) or die (mysql_error());
            while($pr = mysqli_fetch_array($r)){
                $codProv = $pr['codProv'];
                $nomProv = $pr['nomProv'];
                $prov.="<option value='$codProv'> $nomProv </option>";
                
            }
            print $prov;
            ?></select>
                 <br>
                <br><select name='talla' required>
            <option>Selecione Talla</option>
                <?php
        include 'conexion_bd.php';
            $t="";
     
            $query = "SELECT * from talla ";
            $talla=mysqli_query($conex, $query) or die (mysql_error());
            while($pr = mysqli_fetch_array($talla)){
                $codtalla = $pr['idTalla'];
                $nomtalla = $pr['nomTalla'];
                $t.="<option value='$codtalla'> $nomtalla </option>";
                
            }
            print $t;
            
            
            ?></select>
                <br>
                <br>Unidades: <input name="uni" type="number"   placeholder="Unidades > 1" >
                <p>
                    <input name="envio" type="submit" value="Comprar">
                </p>



            </form>
        </div>
    
    
            
        
            
        
    </body>
</html>
    



<?php
/*
include 'conexion_bd.php';

function pintarForm(){
        
}
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Añadir Stock Producto</title>
</head>
    <body>
        <h1 style='margin:10 px; text-align: center ; background-color: aqua'> OFFSIDE STORE</h1>
        <div style=' margin-left: 450px; border: black 2px solid; height: 150px; width: 250px; text-align: center; padding:30px '>
            <form action='.php' method='post'>
            <select name='prod' required>
            <option>Selecione Producto</option>
        <?php
        include 'conexion_bd.php';
            $p="";
     
            $query = "SELECT * from producto ";
            $res=mysqli_query($conex, $query) or die (mysql_error());
            while($prod = mysqli_fetch_array($res)){
                $codProd = $prod['codProd'];
                $nomProd = $prod['nomProd'];
                $p.="<option value='$codProd'> $nomProd </option>";
               
            }
            print $p;
            ?>
            </select><br>
                <br><select name='provedor' required>
            <option>Selecione Proveedor</option>
                <?php
        include 'conexion_bd.php';
            $prov="";
     
            $query = "SELECT * from proveedores ";
            $r=mysqli_query($conex, $query) or die (mysql_error());
            while($pr = mysqli_fetch_array($r)){
                $codProv = $pr['codProv'];
                $nomProv = $pr['nomProv'];
                $prov.="<option value='$codProv'> $nomProv </option>";
                
            }
            print $prov;
            ?></select>
                 <br>
                <br><select name='provedor' required>
            <option>Selecione Talla</option>
                <?php
        include 'conexion_bd.php';
            $t="";
     
            $query = "SELECT * from talla ";
            $talla=mysqli_query($conex, $query) or die (mysql_error());
            while($pr = mysqli_fetch_array($talla)){
                $codtalla = $pr['idTalla'];
                $nomtalla = $pr['nomTalla'];
                $t.="<option value='$codtalla'> $nomtalla </option>";
                
            }
            print $t;
            ?></select>
                <br>
                <br>Unidades: <input name="uni" type="number" value="">
                <p>
                    <input name="envio" type="submit" value="Añadir">
                </p>



            </form>
        </div>
    
    
            
        
            
        
    </body>
</html>
    

*/ ?>