<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

        <?php
        session_start();
        
        
        if (empty($_POST)) {

            $usuario = "";
            $direccion="";
            $contraseña="";
            $email = "";
            $cuenta="";
        } else {
          
            $usuario = $_POST["usuario"];
            $direccion= $_POST["direccion"];
            $contraseña = $_POST["contraseña"];
            $email = $_POST["email"];
            $cuenta= $_POST["cuenta"];
        }
    
           

function validar (  $usuario, $direccion, &$email, $contraseña, $cuenta)
{
    $error="";
        $ok=true;
    if (($cuenta=="")  ||(!preg_match("/^ES*[0-9]{14}/", $cuenta)))
    {    
        $cuenta="";
        $error=$error." / Cuenta vacio o erronea";
        $ok=false;
    }/*else{
        if (!preg_match("/[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}",$cuenta)){
            echo "La cuenta bancaria debe contener 16 digitos";
            print (<a href=".php" Volver al formulario </a>");

            }
return false;
    }*/
    if (($email==""))
    {
        $email="";
        $error=$error." / email incorrecto";
        $ok=false;
    }
    if($usuario==""){
        $usuario="";
        $error=$error." / Usuario vacio";
        $ok=false;
    }
    if($contraseña==""){
        $contraseña="";
        $error = $error."/Contraseña vacia";
        $ok=false;
    }
     if($direccion==""){
        $direccion="";
        $error=$error." / Direccion vacio";
        $ok=false;
    }
        
     if ($error=="")
    {    
        $ok=true;
    }

     
    echo $error;
    return $ok;
    
     
}






function añadirUsuario( $usuario, $direccion, $contraseña, $email, $cuenta,$tipo='usuario')
{
            include 'conexion_bd.php';

 $insertado=false;
 $query_mat="SELECT user FROM usuario WHERE user LIKE '$usuario'";
 $result_mat=mysqli_query($conex, $query_mat) or die(mysqli_error($conex));
 if (mysqli_num_rows($result_mat)!=0)
   {          
    pintar_formulario_Registro( $usuario, $direccion, $contraseña, $email,$cuenta);
     
   }else{
        $query="INSERT INTO usuario 
			(user,password, email,direccion,numCuenta,tipoUser) 
		VALUES ( '$usuario','$contraseña','$email','$direccion' ,'$cuenta','$tipo')";
	$res_alum=mysqli_query($conex, $query) or die (mysqli_error($conex));
	if ($res_alum)
	{
		echo ('Usuario registrado correctamente');
                $insertado = true;
	}
	else
	{
		echo ('Problemas de Inserción');
                $insertado = false;
	}
        
      
   }
   
       
   
return $insertado;       
}







        
function pintar_formulario_Registro(  $usuario, $direccion, $contraseña, $email, $cuenta) {
$registrar= <<<REGISTRO
<form action="Registrar.php" method="post" name="form_datos" enctype="multipart/form-data">    
 <div align="left">
  <p>INTRODUCIR DATOS DE USUARIO</p>
 
  <div>  
  
  <p>Usuario: 
    <input name="usuario" type="text" size="20" maxlength="20" value="$usuario">
    </p>
    <p>Direccion: 
    <input name="direccion" type="text" size="20" maxlength="40" value="$direccion">
    </p>
    <p>Contraseña: 
    <input name="contraseña" type="password" size="20" maxlength="40" value="$contraseña">
    </p>
<p>Email:
    <input type="email" name="email" value="$email">
</p>
        <p>Cuenta Bancaria: 
    <input name="cuenta" type="text" size="20" maxlength="40" value="$cuenta">
    </p>
                    	
	 <p>
    <input type="submit" name="Registrar" value="Registrar">
	</p>
REGISTRO;
            print $registrar;

        }
        ?>

        
        
        
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Registrar Usuario</title>
</head>

<body style="text-align: center">
    <h1 style="margin:10 px; text-align: center ; background-color: aqua"> OFFSIDE STORE</h1>
    <div style=" margin-left: 450px; border: black 2px solid; height: 270px; width: 300px; text-align: center; padding:30px " >

<?php

      if (empty($_POST)) //si aÃºn no se ha enviado el formulario
      {
          pintar_formulario_Registro( $usuario, $direccion,$contraseña, $email,$cuenta); 
          
      }
      else //para cada vez que el formulario se envÃ­e
      {
	//if (!validar_datos($nif, $nom, $email, $f_foto))
          $error="";
          if (!validar( $usuario, $direccion, $contraseña, $email,$cuenta))
	{
              print("Errores: ".$error);
              pintar_formulario_Registro(  $usuario, $direccion,$contraseña, $email,$cuenta); 
		
              

              
              
              
	} else {	
            if(añadirUsuario($usuario, $direccion, $contraseña, $email, $cuenta)==false){
                            header("location: Registrar.php");

            }else{
                            include 'conexion_bd.php';

            $query_mat="SELECT codUser FROM usuario WHERE user LIKE '$usuario'";
            $result=mysqli_query($conex, $query_mat) or die(mysqli_error($conex));
            $codUser = mysqli_fetch_array($result);
            $cod=$codUser['codUser'];
            $_SESSION['codU']= $cod;
            $_SESSION['usuarios']= $usuario;
            $_SESSION['direccion']= $direccion;
            $_SESSION['contraseña']= $contraseña;
            $_SESSION['email']= $email;
            $_SESSION['cuenta']= $cuenta;
            
            header("location: Catalogo.php");
                }
            }

           
	
	}

      ?>
    </div>
    </body>
</html>
