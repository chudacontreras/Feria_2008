<?php
session_start();


include("ControlaBD.php");
include("util.php");
if ($_SESSION["sesion"] != "TRUE") {
	js_redireccion("index.php");
	exit; 
}
$con   = new ControlaBD();
$idcon = $con->conectarSBD();
$sel_bd= $con->select_BD("feria2008");

		$result= $con->ejecutar("SELECT * FROM control where id = 1",$idcon);
		$fila = mysql_fetch_array($result);
		$nro =  $fila["contador"];
		if (strlen($nro) < 6){
			for ($i=strlen($nro); $i < 6; $i++)
			$nro = "0".$nro;
		}
		$result= $con->ejecutar("UPDATE control set contador = contador+1 where id =1",$idcon);
		$codigo = $fila ["item"].$nro;	
$_SESSION['fecha'] = date('Y-m-d G:i:s');
//echo "INSERT INTO cab_ventas values ('".$codigo."',".$_SESSION["cedula"].",".$_POST["total"].",'".$_SESSION["login"]."', NOW(),'H','".$_POST["pago"]."')"; exit;
$guarda= $con->ejecutar("INSERT INTO cab_ventas values ('".$codigo."',".$_SESSION["cedula"].",".$_POST["total"].",'".$_SESSION["login"]."', NOW(),'H','".$_POST["pago"]."')",$idcon);

for ($i=1; $i <= 12; $i++){
	if ($_POST["Cant".$i] > 0){
		//echo "INSERT INTO det_ventas values ('".$codigo."',".$_POST["tip".$i].",".$_POST["dia".$i].",".$_POST["Cant".$i].",".$_POST["sub".$i].")";
		$guarda2= $con->ejecutar("INSERT INTO det_ventas values ('".$codigo."',".$_POST["tip".$i].",".$_POST["dia".$i].",".$_POST["Cant".$i].",".$_POST["sub".$i].")",$idcon);
		//echo "UPDATE clientes SET dia".$_POST["dia".$i]." = dia".$_POST["dia".$i]."+1 WHERE cedula = ".$_SESSION["cedula"];
		$actualiza = $con->ejecutar("UPDATE clientes SET dia".$_POST["dia".$i]." = dia".$_POST["dia".$i]."+1 WHERE cedula = ".$_SESSION["cedula"],$idcon);
	}
}
$_SESSION["codigo"] = $codigo;
js_redireccion("recibo2.php");
?>
