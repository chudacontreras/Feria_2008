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
		
		$totalE = 0; 
		$totalT = 0;

$resultX= $con->ejecutar("SELECT * FROM login WHERE login='".$_POST["vendedor"]."'",$idcon);
$filaX = mysql_fetch_array($resultX);

require('fpdf.php');
$fecha = date("d / m / Y")." a las ".(date("h")-1).":".(date("i A"));
$pdf=new FPDF('P','mm','letter');
$pdf->AddPage();

// ENCABEZADO
$pdf->Image ("./imagenes/alcaldia.jpg", 50,17,10,15, "JPG");
$pdf->SetFont ("arial","",8); //Tamaño de la letra
$pdf->SetXY(1,20);
$pdf->Cell (214, 4, "CORTUBAR",0,1,"C");
$pdf->SetXY(1,24);
$pdf->Cell (214, 4, "Reporte de Liquidación",0,1,"C");

$pdf->SetXY(1,28);
$pdf->Cell (214, 4, $filaX["nombre"]." ".$filaX["apellido"],0,1,"C");
$pdf->Image ("./imagenes/Cortubar.jpg", 150,17,25,15, "JPG");

//Cabecera
$pdf->SetXY(35,42);
$pdf->SetFillColor(200,220,255);
$pdf->Cell (40, 4, 'Código',1,0,"C",1);
$pdf->Cell (45, 4, 'Día',1,0,"C",1);
$pdf->Cell (20, 4, 'Cant.',1,0,"C",1);
$pdf->Cell (20, 4, 'Sub Total',1,0,"C",1);
$pdf->Cell (25, 4, 'Total',1,1,"C",1);

//Contenido del Reporte
$linea = 46;
$pdf->SetY($linea);
$pdf->SetFont ("arial","",7); //Tamaño de la letra
if ($_POST["fecha"] == ""){
	$result= $con->ejecutar("SELECT * FROM cab_ventas WHERE vendedor='".$_POST["vendedor"]."' and fecha like '".date("Y-m-d")."%'",$idcon);
}else{
	$fecha = substr($_POST["fecha"], 6, 4)."-".substr($_POST["fecha"], 3, 2)."-".substr($_POST["fecha"], 0, 2);
	//echo $fecha."     ".$_POST["fecha"]; exit;
	$result= $con->ejecutar("SELECT * FROM cab_ventas WHERE vendedor='".$_POST["vendedor"]."' and fecha like '".$fecha."%'",$idcon);
}


while ($fila = mysql_fetch_array($result)) {
	$result2= $con->ejecutar("SELECT * FROM det_ventas WHERE codigo='".$fila['codigo']."'",$idcon);	
	//$alto = mysql_num_rows($result);
	$alto = 0;
	while ($fila2 = mysql_fetch_array($result2)) {
		if ($fila2['dia'] == 0){
			$dia = "Abono";
		}else{
			$dia = $fila2['dia']." de Septiembre";
		}
		$pdf->SetX(75);
		$pdf->Cell (45, 4, $dia,1,0,"C");
		$pdf->Cell (20, 4, $fila2['cantidad'],1,0,"C");
		$pdf->Cell (20, 4, $fila2['bs'],1,1,"R");
		$alto++;
	}	
	$pdf->SetXY(35,$linea);
	$pdf->Cell (40, 4*$alto,$fila['codigo'],1,0,"C");
	$pdf->SetXY(160,$linea);
	$pdf->Cell (25, 4*$alto,$fila['total'],1,1,"R");

	if ($fila['pago'] == 'E'){// aqui va las condiciones de las formas de pago
		$totalE = $totalE + $fila['total']; 
	}else{
		$totalT = $totalT + $fila['total']; 
	}
	$linea = $linea+($alto*4);	
	$pdf->SetY($linea);
}
$pdf->SetX(140);
$pdf->Cell (20, 4,"Tarjetas",1,0,"C");
$pdf->Cell (25, 4,$totalT,1,1,"R");

$linea = $linea+4;
$pdf->SetY($linea);
$pdf->SetX(140);
$pdf->Cell (20, 4,"Efectivo",1,0,"C");
$pdf->Cell (25, 4,$totalE,1,1,"R");

$linea = $linea+4;
$pdf->SetY($linea);
$pdf->SetX(140);
$pdf->Cell (20, 4,"Total",1,0,"C");
$pdf->Cell (25, 4,$totalE + $totalT,1,1,"R");




if ($_POST["fecha"] == ""){
	$linea = $linea+12;
	$pdf->SetXY(35,$linea);
	$pdf->Cell (75, 4, '________________________________',0,0,"C");
	$pdf->Cell (75, 4, '________________________________',0,1,"C");
	$linea = $linea+4;
	$pdf->SetXY(35,$linea);
	$pdf->Cell (75, 4, 'Recibe: '.$_SESSION["usuario"],0,0,"C");
	$pdf->Cell (75, 4, 'Entrega: '.$filaX["nombre"]." ".$filaX["apellido"],0,1,"C");

	$linea = $linea+4;
	$pdf->SetXY(35,$linea);
	$pdf->Cell (150, 4, 'En Barquisimeto al '.$fecha,0,0,"C");
	
	$linea = $linea+15;
	$pdf->SetXY(35,$linea);
	$pdf->Cell (150, 4, 'Información del Depósito:',0,1,"C");
	$pdf->SetX(35);
	$pdf->Cell (75, 4, 'Banco:',1,0,"L");
	$pdf->Cell (75, 4, 'Cuenta Nro.:',1,1,"L");
	$pdf->SetX(35);
	$pdf->Cell (75, 4, 'Planilla Nro.:',1,0,"L");
	$pdf->Cell (75, 4, 'Fecha:',1,0,"L");
}else{
	$linea = $linea+10;
	$pdf->SetXY(35,$linea);
	$pdf->Cell (150, 4, 'Reporte del Dia: '.$_POST["fecha"],0,0,"C");
}


$pdf->Output('Rep_Liq.pdf','I');

?>
