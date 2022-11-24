<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<--<!-- Listo -->
<?php
        session_start();
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

    include 'conexion_bd.php';

        $query = "SELECT  codUser, user, password, email, direccion, numCuenta, tipoUser
                                FROM usuario
                                WHERE (user LIKE '$usuario') and 
                                    (password LIKE '$contraseña')";
        $res_valid = mysqli_query($conex, $query) or die(mysqli_error($conex));
        //$result = mysqli_fetch_array($res_valid);
        if ((mysqli_num_rows($res_valid) == 0) || !$usuario || !$contraseña) {
            echo "incorrecto";
            header("location: Index.php");
        } else {
            
            $reg_usuario=mysqli_fetch_array($res_valid);
            $tipo = $reg_usuario['tipoUser'];
            if($tipo === 'usuario'){
                $_SESSION['usuario']= $reg_usuario['user'];
                $_SESSION['codU']= $reg_usuario['codUser'];
                $_SESSION['email']= $reg_usuario['email'];
                $_SESSION['direccion']= $reg_usuario['direccion'];
                $_SESSION['cuenta']= $reg_usuario['numCuenta'];
                $_SESSION['tipo']= $reg_usuario['tipoUser'];
                header("location: Catalogo.php");
            }else if($tipo === 'Gerente'){
                $_SESSION['usuario']= $reg_usuario['tipoUser'];
                header("location: cosasGerente.php");
            }else{
                $_SESSION['usuario']= $reg_usuario['tipouser'];
                header("location: cosasEmpleado.php");
            }
            
            
        }
        
        

validarForm($usuario, $contraseña);
    
registrar();
        ?>

