<?php

session_start();
include("ControlaBD.php");
include("util.php");
if ($_SESSION["sesion"] != "TRUE" || $_SESSION["nivel"] != 2) {
	js_redireccion("index.php");
	exit; 
}
$con   = new ControlaBD();
$idcon = $con->conectarSBD();
$sel_bd= $con->select_BD("feria2008");

$_SESSION["codigo"] = $_POST["busca"];
		
		$resultF= $con->ejecutar("SELECT * FROM cab_ventas where codigo='".$_SESSION["codigo"]."'",$idcon);
		$filaF = mysql_fetch_array($resultF);
		$_SESSION["cedula"] = $filaF["cedula"];
		
		$result2= $con->ejecutar("SELECT * FROM clientes where cedula='".$_SESSION["cedula"]."'",$idcon);
		$fila2 = mysql_fetch_array($result2);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Recibo de Pago</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo8 {font-family: Arial, Helvetica, sans-serif; font-size: 9; }
.Estilo9 {font-size: 9}
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
-->
</style>
</head>

<body>

<table width="89%" height="0" border="1" align="center">
  <tr>
    <td height="467"><table width="100%" border="0">
      <tr>
        <td width="11%" align="center" valign="middle"><img src="imagenes/alcaldia.jpg" width="40" height="69" border="0" /></td>
        <td width="44%" align="center" valign="middle">
			<span class="Estilo1">Corporaci&oacute;n de Turismo de Barquisimeto<br>
			<strong>CORTUBAR, C.A.</strong><br>
			Carrera 17 esquina Calle 25, Antigua Casa de Esutoquio Gómez<br>
			Teléfonos: 0251-2321097 / 0416-6522931<br>
		  R.I.F.: G20006212-6          </span></td>
        <td width="13%" align="center" valign="middle"><img src="imagenes/cortubar.gif" width="101" height="56" border="0" /></td>
        <td width="32%" align="center" valign="middle"><span class="Estilo8"><?php echo $_SESSION["codigo"] ?><br>
        </span>          <?php  echo $filaF['fecha'];  ?></td>
      </tr>
    </table>

      <table width="100%" border="0">
        <tr>
          <td width="14%" align="left" class="Estilo1"><span class="Estilo8">Cliente:</span></td>
          <td width="33%" class="Estilo1"><span class="Estilo8"><?php echo $fila2 ["apellidos"]." ".$fila2 ["nombres"]; ?></span></td>
          <td width="6%" class="Estilo1"><span class="Estilo8">Direcci&oacute;n:</span></td>
          <td width="47%" class="Estilo1"><span class="Estilo8"><?php echo $fila2 ["direccion"]; ?></span></td>
        </tr>
        <tr>
          <td align="left" class="Estilo1"><span class="Estilo8">C&eacute;dula / R.I.F.: </span></td>
          <td class="Estilo1"><span class="Estilo8"><?php echo $_SESSION["cedula"]; ?></span></td>
          <td class="Estilo1"><span class="Estilo8">Tel&eacute;fono:</span></td>
          <td class="Estilo1"><span class="Estilo8"><?php echo $fila2 ["telefono"]; ?></span></td>
        </tr>
      </table>
      <table width="100%" border="0">
        <tr>
          <td width="62%" align="center" valign="middle" bgcolor="#CCCCCC"><span class="Estilo12">Descripci&oacute;n</span></td>
          <td width="10%" align="center" valign="middle" bgcolor="#CCCCCC"><span class="Estilo12">Cantidad</span></td>
          <td width="15%" align="center" valign="middle" bgcolor="#CCCCCC"><span class="Estilo12">Precio Unitario</span></td>
          <td width="13%" align="center" valign="middle" bgcolor="#CCCCCC"><span class="Estilo12">Neto</span></td>
        </tr>
<?php
		$result3= $con->ejecutar("SELECT * FROM det_ventas where codigo='".$_SESSION["codigo"]."'",$idcon);
		while ($fila3 = mysql_fetch_array($result3)) {
			//echo "SELECT * FROM cartelera where dia=".$fila3["dia"];
			$result4= $con->ejecutar("SELECT * FROM catelera where dia=".$fila3["dia"],$idcon);
			$fila4 = mysql_fetch_array($result4);
			echo "<tr>";
			if ($fila3["tipo"] == 1){
			echo "<td align='left' height='16' valign='middle'><span class='Estilo1'>Entradas: ".$fila4["artista"]." (".$fila3["dia"]." de Sep.)</span></td>";
			}else{
			echo "<td align='left' height='16' valign='middle'><span class='Estilo1'>Abono para toda la feria</span></td>";
			}
			echo "<td align='right' valign='middle'><span class='Estilo1'>".$fila3["cantidad"]."</span></td>";
			if ($fila3["tipo"] == 1){
			echo "<td align='right' valign='middle'><span class='Estilo1'>30</span></td>";
			}else{
			echo "<td align='right' valign='middle'><span class='Estilo1'>330</span></td>";
			}
			echo "<td align='right' valign='middle'><span class='Estilo1'>".$fila3["bs"]."</span></td>";
			echo "</tr>";					
		}
			echo "<tr>";
			echo "<td align='left' valign='middle'>&nbsp;</td>";
			echo "<td align='right' valign='middle'>&nbsp;</td>";
			echo "<td align='right' valign='middle'>&nbsp;</td>";
			echo "<td align='right' valign='middle'>&nbsp;</td>";
			echo "</tr>";
			$result5= $con->ejecutar("SELECT * FROM cab_ventas where codigo='".$_SESSION["codigo"]."'",$idcon);
			$fila5 = mysql_fetch_array($result5);
			echo "<tr>";
			echo "<td align='left' valign='middle'></td>";
			echo "<td align='right' valign='middle'></td>";
			echo "<td align='right' valign='middle'><span class='Estilo12'>TOTAL Bs.</span></td>";
			echo "<td align='right' valign='middle'><span class='Estilo12'>".$fila5["total"]."</span></td>";
			echo "</tr>";						
?>	
      </table>

		<table width="46%" border="0">
		  <tr>
			<td width="47%" height="2" align="center" valign="middle">___________________</td>
			<td width="10%" align="center" valign="middle">&nbsp;</td>
			<td width="43%" align="center" valign="middle">__________________</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" class="Estilo1">Recibido </td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle" class="Estilo1">Reimpresi&oacute;n: <?php echo $_SESSION["usuario"] ?></td>
		  </tr>
	  </table>	  
	  
    </td>
  </tr>
</table>
<div align="center">-------------------------------------------------------------------------------------------------------------------
</div>
<table width="89%" height="0" border="1" align="center">
  <tr>
    <td height="467"><table width="100%" border="0">
      <tr>
        <td width="11%" align="center" valign="middle"><img src="imagenes/alcaldia.jpg" width="40" height="69" /></td>
        <td width="44%" align="center" valign="middle">
			<span class="Estilo1">Corporaci&oacute;n de Turismo de Barquisimeto<br>
			<strong>CORTUBAR, C.A.</strong><br>
			Carrera 17 esquina Calle 25, Antigua Casa de Esutoquio Gómez<br>
			Teléfonos: 0251-2321097 / 0416-6522931<br>
		  R.I.F.: G20006212-6          </span></td>
        <td width="13%" align="center" valign="middle"><img src="imagenes/cortubar.gif" width="101" height="56" border="0" /></td>
        <td width="32%" align="center" valign="middle"><span class="Estilo8"><?php echo $_SESSION["codigo"] ?><br>
        </span>          <?php  echo $filaF['fecha'];  ?></td>
      </tr>
    </table>

      <table width="100%" border="0">
        <tr>
          <td width="14%" align="left" class="Estilo1"><span class="Estilo8">Cliente:</span></td>
          <td width="33%" class="Estilo1"><span class="Estilo8"><?php echo $fila2 ["apellidos"]." ".$fila2 ["nombres"]; ?></span></td>
          <td width="6%" class="Estilo1"><span class="Estilo8">Direcci&oacute;n:</span></td>
          <td width="47%" class="Estilo1"><span class="Estilo8"><?php echo $fila2 ["direccion"]; ?></span></td>
        </tr>
        <tr>
          <td align="left" class="Estilo1"><span class="Estilo8">C&eacute;dula / R.I.F.: </span></td>
          <td class="Estilo1"><span class="Estilo8"><?php echo $_SESSION["cedula"]; ?></span></td>
          <td class="Estilo1"><span class="Estilo8">Tel&eacute;fono:</span></td>
          <td class="Estilo1"><span class="Estilo8"><?php echo $fila2 ["telefono"]; ?></span></td>
        </tr>
      </table>
      <table width="100%" border="0">
        <tr>
          <td width="62%" align="center" valign="middle" bgcolor="#CCCCCC"><span class="Estilo12">Descripci&oacute;n</span></td>
          <td width="10%" align="center" valign="middle" bgcolor="#CCCCCC"><span class="Estilo12">Cantidad</span></td>
          <td width="15%" align="center" valign="middle" bgcolor="#CCCCCC"><span class="Estilo12">Precio Unitario</span></td>
          <td width="13%" align="center" valign="middle" bgcolor="#CCCCCC"><span class="Estilo12">Neto</span></td>
        </tr>
<?php
		$result3= $con->ejecutar("SELECT * FROM det_ventas where codigo='".$_SESSION["codigo"]."'",$idcon);
		while ($fila3 = mysql_fetch_array($result3)) {
			//echo "SELECT * FROM cartelera where dia=".$fila3["dia"];
			$result4= $con->ejecutar("SELECT * FROM catelera where dia=".$fila3["dia"],$idcon);
			$fila4 = mysql_fetch_array($result4);
			echo "<tr>";
			if ($fila3["tipo"] == 1){
			echo "<td align='left' height='16' valign='middle'><span class='Estilo1'>Entradas: ".$fila4["artista"]." (".$fila3["dia"]." de Sep.)</span></td>";
			}else{
			echo "<td align='left' height='16' valign='middle'><span class='Estilo1'>Abono para toda la feria</span></td>";
			}
			echo "<td align='right' valign='middle'><span class='Estilo1'>".$fila3["cantidad"]."</span></td>";
			if ($fila3["tipo"] == 1){
			echo "<td align='right' valign='middle'><span class='Estilo1'>30</span></td>";
			}else{
			echo "<td align='right' valign='middle'><span class='Estilo1'>330</span></td>";
			}
			echo "<td align='right' valign='middle'><span class='Estilo1'>".$fila3["bs"]."</span></td>";
			echo "</tr>";					
		}
			echo "<tr>";
			echo "<td align='left' valign='middle'>&nbsp;</td>";
			echo "<td align='right' valign='middle'>&nbsp;</td>";
			echo "<td align='right' valign='middle'>&nbsp;</td>";
			echo "<td align='right' valign='middle'>&nbsp;</td>";
			echo "</tr>";
			$result5= $con->ejecutar("SELECT * FROM cab_ventas where codigo='".$_SESSION["codigo"]."'",$idcon);
			$fila5 = mysql_fetch_array($result5);
			echo "<tr>";
			echo "<td align='left' valign='middle'></td>";
			echo "<td align='right' valign='middle'></td>";
			echo "<td align='right' valign='middle'><span class='Estilo12'>TOTAL Bs.</span></td>";
			echo "<td align='right' valign='middle'><span class='Estilo12'>".$fila5["total"]."</span></td>";
			echo "</tr>";						
?>	
      </table>

		<table width="46%" border="0">
		  <tr>
			<td width="47%" height="2" align="center" valign="middle">___________________</td>
			<td width="10%" align="center" valign="middle">&nbsp;</td>
			<td width="43%" align="center" valign="middle">__________________</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" class="Estilo1">Recibido </td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle" class="Estilo1">Reimpresi&oacute;n:<?php echo $_SESSION["usuario"] ?></td>
		  </tr>
	  </table>	  
    </td>
  </tr>
</table>
</body>
</html>
