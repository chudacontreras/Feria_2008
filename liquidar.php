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
$result= $con->ejecutar("select * from login where tipo = 1",$idcon);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Liquidaci&oacute;n</title>
<script>
function IsNumeric(valor)
{
var log=valor.length; var sw="S";
for (x=0; x<log; x++)
{ v1=valor.substr(x,1);
v2 = parseInt(v1);
//Compruebo si es un valor numérico
if (isNaN(v2)) { sw= "N";}
}
if (sw=="S") {return true;} else {return false; }
}

var primerslap=false;
var segundoslap=false;
function formateafecha(fecha)
{
var long = fecha.length;
var dia;
var mes;
var ano;

if ((long>=2) && (primerslap==false)) { dia=fecha.substr(0,2);
if ((IsNumeric(dia)==true) && (dia<=31) && (dia!="00")) { fecha=fecha.substr(0,2)+"-"+fecha.substr(3,7); primerslap=true; }
else { fecha=""; primerslap=false;}
}
else
{ dia=fecha.substr(0,1);
if (IsNumeric(dia)==false)
{fecha="";}
if ((long<=2) && (primerslap=true)) {fecha=fecha.substr(0,1); primerslap=false; }
}
if ((long>=5) && (segundoslap==false))
{ mes=fecha.substr(3,2);
if ((IsNumeric(mes)==true) &&(mes<=12) && (mes!="00")) { fecha=fecha.substr(0,5)+"-"+fecha.substr(6,4); segundoslap=true; }
else { fecha=fecha.substr(0,3);; segundoslap=false;}
}
else { if ((long<=5) && (segundoslap=true)) { fecha=fecha.substr(0,4); segundoslap=false; } }
if (long>=7)
{ ano=fecha.substr(6,4);
if (IsNumeric(ano)==false) { fecha=fecha.substr(0,6); }
else { if (long==10){ if ((ano==0) || (ano<1900) || (ano>2100)) { fecha=fecha.substr(0,6); } } }
}

if (long>=10)
{
fecha=fecha.substr(0,10);
dia=fecha.substr(0,2);
mes=fecha.substr(3,2);
ano=fecha.substr(6,4);
// Año no viciesto y es febrero y el dia es mayor a 28
if ( (ano%4 != 0) && (mes ==02) && (dia > 28) ) { fecha=fecha.substr(0,2)+"-"; }
}
return (fecha);
}
</script>
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
.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 14px; }
.Estilo13 {
	color: #FF0000;
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo15 {color: #000000; font-size: 10px; font-family: Arial, Helvetica, sans-serif; }
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
<div align="center"><br>
	<form method="post" target="_blank" action="liquidacion.php">
	 <table width="35%" border="0">
  <tr>
    <td width="49%" align="right" class="Estilo12">Vendedor:</td>
    <td width="51%">
	    <select name="vendedor" id="vendedor">
				<?php	
					while ($fila = mysql_fetch_array($result)) {
						echo "<option>".$fila["login"]."</option>";
					}	
				?>	
		</select>
	</td>
  </tr>
  <tr>
    <td align="right"><span class="Estilo12">Fecha </span><span class="Estilo15">(dd-mm-aaaa)</span> :</td>
    <td><input name="fecha" type="text" size="10" maxlength="10" onKeyUp = "this.value=formateafecha(this.value);"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle"> <p class="Estilo13">Dejar el Campo &quot;Fecha&quot; 
      en blanco si la liquidaci&oacute;n corresponde al d&iacute;a de hoy </p>
      <p>
        <input type="submit" name="Buscar" value="Buscar" />
        </p></td>
  </tr>
</table>


				
				
	           
	</form>
</div>
<br><br>

</body>
</html>