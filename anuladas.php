<?php
session_start();

include("util.php");
include("ControlaBD.php");
if ($_SESSION["sesion"] != "TRUE" || $_SESSION["nivel"] != 2) {
	js_redireccion("index.php");
	exit; 
}
$con   = new ControlaBD();
$idcon = $con->conectarSBD();
$sel_bd= $con->select_BD("feria2008");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estado de las Ventas</title>
<style>
<!--
a:link {
	color: #DA251D;
	text-decoration:none;
}
a:visited {
	color: #DA251D;
	text-decoration:none;
}
a:hover {
	color: #DA251D;
	text-decoration:none;
}
a:active {
	color: #DA251D;
	text-decoration:none;
}

.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.Estilo8 {font-family: Arial, Helvetica, sans-serif; font-size: 9; }
.Estilo9 {font-size: 11}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 14px; }
-->
</style>
</head>

<body>

<table width="650" height="138" border="1" align="center">
  <tr>
    <td width="75" rowspan="3" align="center"><img src="imagenes/afihe.gif" width="75" height="128" /></td>
    <td height="88" colspan="2" align="center">
        <font color="#CD3232" size="4" face="Arial, Helvetica, sans-serif">Sistema de Pre-venta<br />
Boleter&iacute;a-Abonos<br />Usuario Liquidador<br /></font>
	</td>
  </tr>
  <tr>
    <td width="350" align="center"><font color="#CD3232" size="2" face="Arial, Helvetica, sans-serif"><a href="./edo_vent.php">Estado de Ventas</a></font></td>
    <td width="203" align="center"><font color="#CD3232" size="2" face="Arial, Helvetica, sans-serif"><a href="./reimprime1.php">Reimprimir</a></font></td>
  </tr>  
  <tr>
    <td width="350" align="center"><font color="#CD3232" size="2" face="Arial, Helvetica, sans-serif"><a href="./password.php">Cambiar Password</a></font></td>
    <td width="203" align="center"><font color="#CD3232" size="2" face="Arial, Helvetica, sans-serif"><a href="./liquidar.php">Liquidar</a></font></td>
  </tr>
</table>
<br>
<div align="center">
	B&uacute;squeda de Venta Realizada<br><br>
	<form method="post" action="edo_vent.php">
	donde <select name="campo">
					<option>codigo</option>
					<option>cedula</option>
					<option>vendedor</option>
					<option>fecha</option>
					<option>estatus</option>
			</select>  sea igual a: <input type="text" name="busca">
			<input type="submit" name="Buscar" value="Buscar">	
	</form>
</div>
<br><br>
<table width="350" border="0" align="center">
<tr>
	<td align="center" bgcolor="#CCCCCC"><span class="Estilo12">C&oacute;digo</span></td>
	<td align="center" bgcolor="#CCCCCC"><span class="Estilo12">Status</span></td>
</tr>

<?php

	
$contador = 0;
while ($contador < $_POST["nro"]){
	if ($_POST["c".$contador] == "on"){
		//echo $_POST["c".$contador];
		//echo "update cab_ventas set estatus = 'A' where codigo='".$_POST["n".$contador]."'<br>";
		$result= $con->ejecutar("update cab_ventas set estatus = 'A' where codigo='".$_POST["n".$contador]."'",$idcon);
		echo "<tr bgcolor='#B5C3DE'>";
		echo "<td align='center'><span class='Estilo1'>".$_POST["n".$contador]."</span></td>";
		echo "<td align='center'><span class='Estilo1'>Anulada</span></td>";
		echo "</tr>";
	}
	$contador++;
}	

?>


</table>

</body>
</html>