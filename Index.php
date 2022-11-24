
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
	session_unset();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Documento sin t&iacute;tulo</title>
</head>

<body >
    <h1 style="margin:10 px; text-align: center ; background-color: aqua"> OFFSIDE STORE</h1>

    <br>
    <br>
    <div style=" margin-left: 450px; border: black 2px solid; height: 100px; width: 300px; text-align: center; padding:30px " >
        <form action="validar.php" method="post" >
        
	<p>
            <label>Usuario: </label> <input name=" usuario"  type="text">
	</p>
	<p>
	<label>Contraseña: </label> <input name="contraseña" type="password" maxlength="8">
	</p>
	<p>

	<input name="envio" type="submit" value="Entrar">
       
	</p>
</form> 
        <a href="Registrar.php"><button style="margin-left: 25px">Registrar Nuevo Usuario</button></a>
    </div>
    

</body>
</html>

