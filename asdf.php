<?php
session_start();
/*

AMBIENTE DE DESARROLLO

*/

include("util.php");
if ($_SESSION["sesion"] != "TRUE") {
	js_redireccion("index.php");
	exit; 
}

require('fpdf.php');



class PDF extends FPDF
{
//Cabecera de página
function Header()
{
	//Logo
	$fecha = date("d / m / Y")." a las ".(date("h")-1).":".(date("i A"));
	$this->Image('./imagenes/Cortubar.jpg',10,10,30);
	$this->Image('./imagenes/Alcaldia.jpg',180,8,15);
	//Arial bold 15
	$this->SetFont('Arial','B',8);
	//Movernos a la derecha
	$this->Cell(80);
	//Título
	$this->Cell(30,10,'REPORTE DIARIO DE VENTAS',0,0,'C');
	$this->Ln(4);
	$this->Cell(190,10,$fecha,0,0,'C');
	$this->Ln(4);
	$this->Cell(190,10,'Vendedor(a):'.$_SESSION["usuario"],0,0,'C');
	//Salto de línea
	$this->Ln(30);
}

//Pie de página
function Footer()
{
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',6);
	//Número de página
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

//Cargar los datos
function LoadData($file)
{
	//Leer las líneas del fichero
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		$data[]=explode(';',chop($line));
	return $data;
}

//Tabla simple
function BasicTable($header)
{
	//Cabecera
	foreach($header as $col)
		$this->Cell(40,7,$col,1);
	$this->Ln();
}

//Una tabla más completa
function ImprovedTable($header)
{
	//Anchuras de las columnas
	$w=array(40,20,40,45,20,20);
	//Cabeceras
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C');
	$this->Ln();
	//Datos

}

//Tabla coloreada
function FancyTable($header)
{
	//Colores, ancho de línea y fuente en negrita
	$this->SetFillColor(255,0,0);
	$this->SetTextColor(255);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	//Cabecera
	$w=array(25,10,85,25,25,25);
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
	$this->Ln();
	//Restauración de colores y fuentes
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	//Datos
	$fill=0;
	
	include("ControlaBD.php");

	$con   = new ControlaBD();
	$idcon = $con->conectarSBD();
	$sel_bd= $con->select_BD("p_feria2008");
	$result= $con->ejecutar("SELECT * FROM cab_ventas WHERE vendedor='".$_SESSION["login"]."'",$idcon);
	
    while ($fila = mysql_fetch_array($result)) {
     $this->Cell($w[0],6,$fila[codigo],1,'L');
	 $this->Cell($w[1],6,$fila[rif],1,'L');
	 	
	$resempre= $con->ejecutar("SELECT nombre FROM empresa WHERE rif='$fila[rif]'",$idcon);
	$empr = mysql_fetch_array($resempre);
	
	 $this->Cell($w[2],6,$empr[nombre],1,'L');
       /*if ($fila[Statu]=='1'){
	       $statu='Inicial';
	   }elseif ($fila[Statu]=='2'){
	       $statu='Abono';
	   } 
	 $this->Cell($w[3],6,$statu,1,'L');*/
	 $restransac= $con->ejecutar("SELECT sum(monto) as totaldepo FROM transacciones WHERE nrocontrato='$fila[numero]'",$idcon);
     $trans = mysql_fetch_array($restransac);
	 $acumdepo = number_format($trans[totaldepo],2,',','.'); 
     $this->Cell($w[3],6,$acumdepo,1,'L');
	
	 $resta = number_format($fila[resta],2,',','.'); 
	 $this->Cell($w[4],6,$resta,1,'L');
	 $acum=$acum+$fila[resta];
	 $totalbs = number_format($fila[total],2,',','.');
	 $this->Cell($w[5],6,$totalbs,1,'L');
	 $this->Ln();
    }
}
}



$pdf=new PDF();
$header=array('Codigo','Cant','Día','Sub_Total','Total Bs.');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->FancyTable($header);
$pdf->Output('reporte_empresa.pdf','I'); //para que muestre la opcion de descargar el reporte

?>
