<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if(!function_exists('crearPdf'))
{
	function crearPdf($nombre, $datos)
	{
		$ci =& get_instance();
		$ci->pdf = new Pdf();
		$ci->pdf->AddPage();
        // Define el alias para el número de página que se imprimirá en el pie
        $ci->pdf->AliasNbPages();
 
        /* Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
        $ci->pdf->SetTitle("");
        $ci->pdf->SetFillColor(200,200,200);
        $ci->pdf->SetMargins(15,15,15);
        $ci->pdf->SetAutoPageBreak(true,25);
        
        /*$this->pdf->Cell(15,7,'NUM','TBL',0,'C','1');
        $this->pdf->Cell(25,7,'PATERNO','TB',0,'L','1');
        $this->pdf->Cell(25,7,'MATERNO','TB',0,'L','1');
        $this->pdf->Cell(25,7,'NOMBRE','TB',0,'L','1');
        $this->pdf->Cell(40,7,'FECHA DE NACIMIENTO','TB',0,'C','1');
        $this->pdf->Cell(25,7,'GRADO','TB',0,'L','1');
        $this->pdf->Cell(25,7,'GRUPO','TBR',0,'C','1');
        $this->pdf->Ln(7);*/

 		$txt="";
        $fecha="";
        $temp="Enero, 2, 2015 (13:30)";
        $fecha = "Fecha de muestreo: ".$temp;
 		$x=1;

        $ci->pdf->SetFont('Arial','BI',18);
        $ci->pdf->Cell(20);
        $ci->pdf->Cell(0,10,'REPORTE DE ANALISIS MICROBIOLOGICO',0,1,'C');

        $ci->pdf->SetFont('Arial', '', 12);
        $ci->pdf->Cell(30);
        $ci->pdf->Cell(0,6,'',0,1,'R');
        $ci->pdf->Cell(0,6,$fecha,0,1,'R');

        $temp = "Enero, 2, 2015";
        $fecha = "Fecha de análisis: ".$temp;
        

        $ci->pdf->SetFont('Arial', '', 12);
        $ci->pdf->Cell(30);
        $ci->pdf->Cell(0,6,$fecha,0,1,'R');

        $temp = "Enero, 6, 2015";
        $fecha = "Fecha de resultados: ".$temp;


        $ci->pdf->SetFont('Arial', '', 12);
        $ci->pdf->Cell(30);
        $ci->pdf->Cell(0,6,$fecha,0,1,'R');
        $ci->pdf->Cell(0,6,"\n\n",0,1,'R');

        $temp="AGUA PURIFICADA";
        $descripcion="Descripción de la Muestra: ";

        $ci->pdf->SetFont('Arial', '', 11);
        $ci->pdf->Cell(50,6,$descripcion,0,0,'L');
        $ci->pdf->SetFont('Arial', 'B', 11);
        $ci->pdf->Cell(15,6,$temp,0,1,'L');

        $temp="DISTRIBUIDORA Y PRODUCTORA BLANCO SA DE CV";
        $procedenica="Procedencia: ";

        $ci->pdf->SetFont('Arial', '', 11);
        $ci->pdf->Cell(30,6,$procedenica,0,0,'L');
        $ci->pdf->SetFont('Arial', 'B', 11);
        $ci->pdf->Cell(15,6,$temp,0,1,'L');

        $temp="Avenida Humbold No. 303";

        $ci->pdf->SetFont('Arial', 'I', 9);
        $ci->pdf->Cell(30,6,"",0,0,'L');
        $ci->pdf->Cell(15,6,$temp,0,1,'L');

        /*
        $fecha += "Fecha de análisis: ";
        $fecha += "Enero, 2, 2015";
        $fecha += "Fecha de análisis: ";
        $fecha += "Enero, 2, 2015";
        $fecha += "Fecha de muestreo: ";
        $fecha += "Enero, 6, 2015";*/
        

 		$txt="Resultados: ";
        $ci->pdf->SetFont('Arial', 'B', 12);
 		$ci->pdf->Cell(30,6,$txt,0,1,'L');
 		//$ci->pdf->Cell(6,6,$nombre."\n\n",0,1,'L');
 		$ci->pdf->Cell(6,6,"\n\n",0,1,'L');

        foreach ($datos->result() as $row)
        {
        	$ci->pdf->SetFont('Arial', '', 12);
        	$txt = $row->descripcion."\n\n";
        	$txt = strip_tags(iconv('UTF-8', 'windows-1252',$txt));
            $ci->pdf->Cell(5);
        	$ci->pdf->MultiCell(0,6,$txt,0,'l');
        	$ci->pdf->SetFont('Arial', 'B', 11);
        	$txt=$row->resultado." ".$row->medida."\n".$row->referencia."\n\n";
        	$txt=iconv('UTF-8', 'windows-1252',$txt);
        	$ci->pdf->MultiCell(0,6,$txt,0,'C');
        	$x++;
        }
            


        $ci->pdf->Output("Reporte.pdf", 'I');
	}
}