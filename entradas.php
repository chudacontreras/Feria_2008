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
		$telefono = $_POST[cod].$_POST[telefono];
		$result= $con->ejecutar("INSERT INTO clientes values (".$_POST[cedula].",'".$_POST[nombres]."','".$_POST[apellidos]."','".$_POST[direccion]."','".$telefono."',0,0,0,0,0,0,0,0,0,0,0)",$idcon);
		//echo "INSERT INTO clientes values (".$_POST[cedula].",'".$_POST[nombres]."','".$_POST[apellidos]."','".$_POST[direccion]."','".$telefono."',0,0,0,0,0,0,0,0,0,0)";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Venta de Entradas y Abonos</title>
<script language="javascript">
function validar(formulario) {
  if (formulario.total.value.length < 2) {
    alert("Debe Adquirir por lo menos una entrada");
    //formulario.nombres.focus();
    return (false);
  }  
  return (true);
}
</script>

<script>
function calculo(cantidad,precio,inputtext,totaltext){
    indice = document.getElementById(cantidad).selectedIndex;
	subtotal = precio*indice;
	inputtext.value=subtotal;
	//alert (cantidad);
	
	total = eval(document.getElementById('sub1').value) + eval(document.getElementById('sub2').value) + eval(document.getElementById('sub3').value) + eval(document.getElementById('sub4').value) + eval(document.getElementById('sub5').value) + eval(document.getElementById('sub6').value) + eval(document.getElementById('sub7').value) + eval(document.getElementById('sub8').value) + eval(document.getElementById('sub9').value) + eval(document.getElementById('sub10').value) + eval(document.getElementById('sub11').value) + eval(document.getElementById('sub12').value);
	totaltext.value = total;
}
</script>

<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>
<body>

<table width="938" height="400" border="1" align="center">
  <tr>
    <td width="32" align="center"><img src="imagenes/afihe.gif" width="213" height="425"></td>
    <td width="1486" align="center">
	
		<div align="center">
		<?php
		echo "<br><br>".$_POST[nombres]." ".$_POST[apellidos]."<br>";
		echo $_POST[cedula]."<br><br>";
		?>
		</div>

		<table width="100%" border="0" align="center">
		<form name="frm_venta" onSubmit = "return validar(this)" action="recibo.php" method="post">
		  <tr>
			<td align="center" valign="middle" bgcolor="#3A3129"><span class="Estilo1">Cantidad</span></td>
			<td align="center" valign="middle" bgcolor="#3A3129"><span class="Estilo1">D&iacute;a</span></td>
			<td align="center" valign="middle" bgcolor="#3A3129"><span class="Estilo1">Artistas</span></td>
			<td align="center" valign="middle" bgcolor="#3A3129"><span class="Estilo1">Sub-total</span></td>
		  </tr>
		  <tr>
			<input type="hidden" name="entrada" value="30" />
			<input type="hidden" name="abono" value="330" />
			<td width="10%" align="center" valign="middle" bgcolor="#E2AC35">
				<input type="hidden" name="dia1" value="11">
				<input type="hidden" name="tip1" value="1">
				<select name="Cant1" id="Cant1" onChange="calculo(this.name,entrada.value,sub1,total);">
					<option>0</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>			</td>
			<td width="7%" align="center" valign="middle" bgcolor="#E2AC35">11</td>
			<td width="71%" bgcolor="#E2AC35">David Bisbal - Carlos Vives - A.5</td>
			<td width="12%" bgcolor="#E2AC35"><input id="sub1" name="sub1" type="text" value="0" readonly="yes" size="5" />
			  Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#EFE136">
				<input type="hidden" name="dia2" value="12">
				<input type="hidden" name="tip2" value="1">
			<select name="Cant2" id="Cant2" onChange="calculo(this.name,entrada.value,sub2,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td align="center" valign="middle" bgcolor="#EFE136">12</td>
			<td bgcolor="#EFE136">Wisin y Yandel - Tito el Bambino - Doble Impakto</td>
			<td bgcolor="#EFE136"><input id="sub2" name="sub2" type="text" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#E2AC35">
				<input type="hidden" name="dia3" value="13">
				<input type="hidden" name="tip3" value="1">			
			<select name="Cant3" id="Cant3" onChange="calculo(this.name,entrada.value,sub3,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td align="center" valign="middle" bgcolor="#E2AC35">13</td>
			<td bgcolor="#E2AC35">RBD - Tecupae</td>
			<td bgcolor="#E2AC35"><input name="sub3" type="text" id="sub3" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#EFE136">
				<input type="hidden" name="dia4" value="14">
				<input type="hidden" name="tip4" value="1">			
			<select name="Cant4" id="Cant4" onChange="calculo(this.name,entrada.value,sub4,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td align="center" valign="middle" bgcolor="#EFE136">14</td>
			<td bgcolor="#EFE136">Olga Tañon - Omar Enrique - Billos</td>
			<td bgcolor="#EFE136"><input name="sub4" type="text" id="sub4" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#E2AC35">
				<input type="hidden" name="dia5" value="15">
				<input type="hidden" name="tip5" value="1">			
			<select name="Cant5" id="Cant5" onChange="calculo(this.name,entrada.value,sub5,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td align="center" valign="middle" bgcolor="#E2AC35">15</td>
			<td bgcolor="#E2AC35">Noche Llanera</td>
			<td bgcolor="#E2AC35"><input name="sub5" type="text" id="sub5" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#EFE136">
				<input type="hidden" name="dia6" value="16">
				<input type="hidden" name="tip6" value="1">			
			<select name="Cant6" id="Cant6" onChange="calculo(this.name,entrada.value,sub6,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td align="center" valign="middle" bgcolor="#EFE136">16</td>
			<td bgcolor="#EFE136">Silvestre Dangond - Jorge Celedon - Nelson Velasquez - Los Diablitos - El Binomio de Oro</td>
			<td bgcolor="#EFE136"><input name="sub6" type="text" id="sub6" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#E2AC35">
				<input type="hidden" name="dia7" value="17">
				<input type="hidden" name="tip7" value="1">			
			<select name="Cant7" id="Cant7" onChange="calculo(this.name,entrada.value,sub7,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td align="center" valign="middle" bgcolor="#E2AC35">17</td>
			<td bgcolor="#E2AC35">Colina - Frank Quintero - Yordano - Karina</td>
			<td bgcolor="#E2AC35"><input name="sub7" type="text" id="sub7" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#EFE136">
				<input type="hidden" name="dia8" value="18">
				<input type="hidden" name="tip8" value="1">			
			<select name="Cant8" id="Cant8" onChange="calculo(this.name,entrada.value,sub8,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td align="center" valign="middle" bgcolor="#EFE136">18</td>
			<td bgcolor="#EFE136">Kudai - Fanny Lu - Voz Veis - Yesi Milano</td>
			<td bgcolor="#EFE136"><input name="sub8" type="text" id="sub8" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#E2AC35">
				<input type="hidden" name="dia9" value="19">
				<input type="hidden" name="tip9" value="1">			
			<select name="Cant9" id="Cant9" onChange="calculo(this.name,entrada.value,sub9,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td align="center" valign="middle" bgcolor="#E2AC35">19</td>
			<td bgcolor="#E2AC35">Juanes - Malanga - Palo Santo</td>
			<td bgcolor="#E2AC35"><input name="sub9" type="text" id="sub9" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#EFE136">
				<input type="hidden" name="dia10" value="20">
				<input type="hidden" name="tip10" value="1">			
			<select name="Cant10" id="Cant10" onChange="calculo(this.name,entrada.value,sub10,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td align="center" valign="middle" bgcolor="#EFE136">20</td>
			<td bgcolor="#EFE136">Franco de Vita - Aventura - Bacanos</td>
			<td bgcolor="#EFE136"><input name="sub10" type="text" id="sub10" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#E2AC35">
				<input type="hidden" name="dia11" value="21">
				<input type="hidden" name="tip11" value="1">
			<select name="Cant11" id="Cant11" onChange="calculo(this.name,entrada.value,sub11,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td align="center" valign="middle" bgcolor="#E2AC35">21</td>
			<td bgcolor="#E2AC35">Marc Anthony - Guaco</td>
			<td bgcolor="#E2AC35"><input name="sub11" type="text" id="sub11" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle" bgcolor="#EFE136">
				<input type="hidden" name="dia12" value="0">
				<input type="hidden" name="tip12" value="2">			
			<select name="Cant12" id="Cant12" onChange="calculo(this.name,abono.value,sub12,total);">
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select></td>
			<td bgcolor="#EFE136">&nbsp;</td>
			<td bgcolor="#EFE136">Abonos</td>
			<td bgcolor="#EFE136"><input name="sub12" type="text" id="sub12" value="0" readonly="yes" size="5" />
		    Bs.</td>
		  </tr>
		  <tr>
			<td align="center" valign="middle">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>  
		  <tr>
			<td align="center" valign="middle" colspan="3">TOTAL</td>
			<td align="center"><input name="total" type="text" value="0" readonly="yes" size="5" /> 
			  Bs.</td>
		  </tr> 
		  <tr>
			<td colspan="4" align="center" valign="middle">
				<br>
				<table width="31%" border="0">
				  <tr>
					<td colspan="4" align="center">Forma de Pago</td>
				  </tr>
				  <tr>
					<td width="7%"><input name="pago" type="radio" value="E" checked></td>
					<td width="44%">Efectivo</td>
					<td width="7%"><input name="pago" type="radio" value="T"></td>
					<td width="42%">Tarjeta</td>
				  </tr>
			  </table>
			  <br>
			</td>
		  </tr>		  
		  <tr>
			<td align="center" valign="middle" colspan="4">
				<input type="submit" name="enviar" value="Enviar">
				<input type="button" name="enviar" value="Cancelar" onClick="javascript:history.back();">			</td>
		  </tr>		   
		  </form>
	</table>	</td>
  </tr>
</table>
</body>
</html>
