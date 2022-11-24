<?php
    include 'conexion_bd.php';

    $nom=$_POST['provedor'];
    function pintarForm($nom){
        
        $prov="<h1 style='margin:10 px; text-align: center ; background-color: aqua'> OFFSIDE STORE</h1>
        <div style=' margin-left: 450px; border: black 2px solid; height: 150px; width: 250px; text-align: center; padding:30px '>
            <form action='validarBajaProv.php' method='post'>
                      <select name='provedor' required>
            <option>Selecione Proveedor:</option>";
     
             $query = "SELECT * from proveedores ";
            $res=mysqli_query($conex, $query) or die (mysql_error());
            while($prov = mysqli_fetch_array($res)){
                $codProv = $prov['codProv'];
                $nomProv = $prov['nomProv'];
                $prov.="<option value='$codProv'> $nomProv </option>";
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
        $query = "DELETE FROM `proveedores` WHERE codProv = $nom ";
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
<title>Documento sin t&iacute;tulo</title>
</head>
<body>
    <?php 
        $nom=$_POST['provedor'];    
            if(eliminar($nom)){
              //  print ("<script language='JavaScrip' type='text/JavaScript'>var mensaje='COMPRA REALIZADA';alert(mensaje);</script>'");
                header("location: cosasGerente.php");
            }else{
                echo 'error al eliminar prov';
            }
        
?>
</body>
</html>