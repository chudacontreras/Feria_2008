<?php
session_start();

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>XXXVI Feria Internacional de Barquisimeto</title>
</head>
<body>
<table width="650" height="400" border="1" align="center">
  <tr>
    <td width="213" align="center"><img src="imagenes/afihe.gif" width="213" height="425"></td>
    <td width="421" align="center"><font color="#CD3232" size="4" face="Arial, Helvetica, sans-serif">Sistema de Pre-venta<br />
Boleter&iacute;a-Abonos </font><br>
<br>
<form method="post" action="sesion.php">
			<font size="2" face="Arial, Helvetica, sans-serif"><strong>Nombre de Usuario:</strong></font><br>
			<input type="text" name="usuario"><br><br>
			<font size="2" face="Arial, Helvetica, sans-serif"><strong>Contrase&ntilde;a:</strong></font><br>
			<input type="password" name="password"><br><br>
			<input type="submit" name="enviar" value="Aceptar">
	  </form>	</td>
  </tr>
  <!---tr>
    <td>&nbsp;</td>
    <td width="279"><div align="right"><img src="Imagenes/logos.gif"></div></td>
    <td width="196"><div align="center"><img src="Imagenes/fabiolaI.gif"></div></td>
  </tr--->
</table>
</body>
</html>
