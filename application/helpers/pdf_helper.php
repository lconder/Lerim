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

        $txt="";
        $fecha="";
        $temp="";
        $descripcion="";
        $procedenica="";
       

        $temp=$nombre['fecha']." (".$nombre['hora'].")";
            $fecha = "Fecha de muestreo: ".$temp;
            

            $ci->pdf->SetFont('Arial','BI',18);
            $ci->pdf->Cell(20);
            $ci->pdf->Cell(0,10,'REPORTE DE ANALISIS MICROBIOLOGICO',0,1,'C');

            $ci->pdf->SetFont('Arial', '', 12);
            $ci->pdf->Cell(30);
            $ci->pdf->Cell(0,6,'',0,1,'R');
            $ci->pdf->Cell(0,6,$fecha,0,1,'R');

            $temp = $nombre['fecha_analisis'];
            $fecha = "Fecha de análisis: ".$temp;
            

            $ci->pdf->SetFont('Arial', '', 12);
            $ci->pdf->Cell(30);
            $ci->pdf->Cell(0,6,iconv('UTF-8', 'windows-1252',$fecha),0,1,'R');

            $temp = $nombre['fecha_resultado'];
            $fecha = "Fecha de resultados: ".$temp;


            $ci->pdf->SetFont('Arial', '', 12);
            $ci->pdf->Cell(30);
            $ci->pdf->Cell(0,6,$fecha,0,1,'R');
            $ci->pdf->Cell(0,6,"\n\n",0,1,'R');

            $temp=  $nombre['nombre_muestra'];
            $descripcion="Descripción de la Muestra: ";

            $ci->pdf->SetFont('Arial', '', 11);
            $ci->pdf->Cell(50,6,iconv('UTF-8', 'windows-1252',$descripcion),0,0,'L');
            $ci->pdf->SetFont('Arial', 'B', 11);
            $ci->pdf->Cell(15,6,strtoupper($temp),0,1,'L');

            $temp=$nombre['empresa'];
            $procedenica="Procedencia: ";

            $ci->pdf->SetFont('Arial', '', 11);
            $ci->pdf->Cell(30,6,$procedenica,0,0,'L');
            $ci->pdf->SetFont('Arial', 'B', 11);
            $ci->pdf->Cell(15,6,strtoupper($temp),0,1,'L');

            $temp=$nombre['direccion'];

            $ci->pdf->SetFont('Arial', 'I', 9);
            $ci->pdf->Cell(30,6,"",0,0,'L');
            $ci->pdf->Cell(15,6,$temp,0,1,'L');

            $txt="Resultados: ";
            $ci->pdf->SetFont('Arial', 'B', 12);
            $ci->pdf->Cell(30,6,$txt,0,1,'L');
            $ci->pdf->Cell(6,6,"\n\n",0,1,'L');
 		

        $x=1;
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
            
        $ci->pdf->SetY(-76);
        $ci->pdf->SetFont('Arial', '', 12);
        $ci->pdf->MultiCell(0,6,"\n",0,'C');
        $ci->pdf->MultiCell(0,6,"ATENTAMENTE",0,'C');
         $ci->pdf->MultiCell(0,6,"\n",0,'C');
          $ci->pdf->MultiCell(0,6,"\n",0,'C');
        $ci->pdf->MultiCell(0,6,"D. en C. FAUSTO TEJEDA TRUJILLO",0,'C');
        $ci->pdf->SetFont('Arial', 'I', 10);
        $ci->pdf->MultiCell(0,6,iconv('UTF-8', 'windows-1252',"Microbiólogo Sanitario"),0,'C');
        $ci->pdf->MultiCell(0,6,"Instructor HACCP Certificado por la alianza Internacional",0,'C');
        $ci->pdf->MultiCell(0,6,"Instructor Externo avalado por la S.T.P.S.",0,'C');


        $ci->pdf->Output("Reporte.pdf", 'I');
	}
}