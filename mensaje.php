<?php
session_start();
include("util.php");
if ($_SESSION["sesion"] != "TRUE") {
	js_redireccion("index.php");
	exit; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table width="650" height="434" border="1" align="center">
  <tr>
    <td width="222" rowspan="2" align="center"><img src="../feria2008/imagenes/afihe.gif" width="213" height="425" /></td>
    <td height="390" colspan="2" align="center">
        <font color="#CD3232" size="4" face="Arial, Helvetica, sans-serif">Sistema de Pre-venta<br />
Boletería - Abonos</font><br><br> <font size="4" face="Arial, Helvetica, sans-serif"><?php echo $_GET['msg']; ?><br><br>
<a href="ppal.php">Volver</a></font>	</td>
  </tr>
</table>
</body>
</html>
