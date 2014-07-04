<?php

	include("ControlaBD.php");

	$con   = new ControlaBD();
	$idcon = $con->conectarSBD();
	$sel_bd= $con->select_BD("feria2008");
	
	$login    = $_POST["usuario"];
	$password = $_POST["password"];

	$result= $con->ejecutar("SELECT * FROM login WHERE login='$login' and pass='$password'",$idcon);
	$fila  = mysql_fetch_array($result);

	if ($fila){

			session_start();
			$_SESSION["sesion"] = "TRUE";
			$_SESSION["login"]    = $login;
			$_SESSION["password"] = $password;
			$_SESSION["nivel"] = $fila["tipo"];
			$_SESSION["usuario"] = $fila["nombre"]." ". $fila["apellido"];
			//$_SESSION["rif"] = $fila["rifemp"];
			//$_SESSION["tusu"] = $fila["codtipo"];
			//$_SESSION["valor"] = "true";
			if ($_SESSION["nivel"] == 2){ 
				Header ("location: ppal2.php"); 
			}else{
				Header ("location: ppal.php"); 
			}
	} else{
			include("index.php");
			echo "<h3 align=center> Login Incorrecto...!</h3>";
	}

?>
