<?php
    include 'conexion_bd.php';

    $nom=$_POST['prov'];
    $cuenta=$_POST['cuenta'];
    function pintarForm($nom,$cuenta){
        
    $form =<<<Form
        <h1 style="margin:10 px; text-align: center ; background-color: aqua"> OFFSIDE STORE</h1>
        <div style=" margin-left: 450px; border: black 2px solid; height: 150px; width: 250px; text-align: center; padding:30px ">
            <form action="validarAltaProv.php" method="post">
                <p>
                    <label>Nombre Proveedor: </label> <input name="prov"  type="text" value="$nom">
                </p>
                <p>
                    <label>Numero de cuenta: </label> <input name="cuenta" "type="text" maxlength="8" value="$cuenta">
                </p>
                <p>
                    <input name="envio" type="submit" value="Registrar">
                </p>



            </form>
        </div>
Form;     
    print $form;
}
function validarP($nom, $cuenta){
        $error="";
        $ok=true;
        if($nom==""){
            $error .= "/Nombre vacio";
            $ok=false;
        }
        if($cuenta==""){
            $error .= "/Cuenta vacia";
            $ok=false;
        }

        include 'conexion_bd.php';

        $query = "SELECT * FROM proveedores WHERE nomProv = '$nom' ";
        $res=mysqli_query($conex, $query) or die (mysql_error());
        if (mysqli_num_rows($res)!=0){
 
            $error.= '/El nombre del proveedor ya esta registrado';
            $ok=false;
        }

        print $error;
        return $ok;


    }

    
    function registrarP($nom,$cuenta){
        include 'conexion_bd.php';
        $ok=false;
        $query = "INSERT INTO `proveedores`(`nomProv`, `numCuenta`) VALUES ('$nom','$cuenta') ";
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
        $nom=$_POST['prov'];
        $cuenta=$_POST['cuenta'];
    
        if (!validarP($nom, $cuenta)){
            pintarForm($nom, $cuenta);
        }else{
            if(registrarP($nom, $cuenta)){
              //  print ("<script language='JavaScrip' type='text/JavaScript'>var mensaje='COMPRA REALIZADA';alert(mensaje);</script>'");
                header("location: cosasGerente.php");
            }
        }
?>
</body>
</html>