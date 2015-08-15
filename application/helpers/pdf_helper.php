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
        $ci->pdf->SetTitle("Lista de alumnos");
        $ci->pdf->SetFillColor(200,200,200);
        $ci->pdf->SetMargins(15,15,15);
        $ci->pdf->SetAutoPageBreak(true,25);
        


        /*
 
        $this->pdf->Cell(15,7,'NUM','TBL',0,'C','1');
        $this->pdf->Cell(25,7,'PATERNO','TB',0,'L','1');
        $this->pdf->Cell(25,7,'MATERNO','TB',0,'L','1');
        $this->pdf->Cell(25,7,'NOMBRE','TB',0,'L','1');
        $this->pdf->Cell(40,7,'FECHA DE NACIMIENTO','TB',0,'C','1');
        $this->pdf->Cell(25,7,'GRADO','TB',0,'L','1');
        $this->pdf->Cell(25,7,'GRUPO','TBR',0,'C','1');
        $this->pdf->Ln(7);*/

 		$txt="";
 		$x=1;
 		$ci->pdf->SetFont('Arial', '', 12);
 		$txt="Resultados de ";
 		$ci->pdf->Cell(30,6,$txt,0,0,'L');
 		$ci->pdf->SetFont('Arial', 'B', 12);
 		$ci->pdf->Cell(6,6,$nombre."\n\n",0,1,'L');
 		$ci->pdf->Cell(6,6,"\n\n",0,1,'L');

        foreach ($datos->result() as $row)
        {
        	$ci->pdf->SetFont('Arial', '', 12);
        	$txt=$row->descripcion."\n\n";
        	$txt=strip_tags(iconv('UTF-8', 'windows-1252',$txt));
        	$ci->pdf->MultiCell(0,6,$txt,0,'J');
        	$ci->pdf->SetFont('Arial', 'B', 12);
        	$txt=$row->resultado." ".$row->medida."\n".$row->referencia."\n\n";
        	$txt=iconv('UTF-8', 'windows-1252',$txt);
        	$ci->pdf->MultiCell(0,6,$txt,0,'R');
        	$x++;
        }

        $ci->pdf->Output("Reporte.pdf", 'I');
	}
}