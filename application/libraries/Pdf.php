<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header()
        {
            //$this->Image(base_url("assets/img/edit.png"),10,8,22);
            $this->SetFont('Arial','B',15);
            $this->SetTextColor(26,35,126);
            $this->Cell(30);
           // $this->Cell(160,10,'LABORATORIO DE ANALISIS CLINICOS Y MICROBIOLOGICOS',0,0,'C');
            $this->Cell(160,10,'',0,0,'C');
            $this->Ln('5');
            $this->Ln('5');
            $this->SetFont('Arial','IU',15);
            $this->SetTextColor(26,35,126);
            $this->Cell(30);
           // $this->Cell(120,10,'Fausto Tejeda Trujillo',0,0,'C');
           //$this->Cell(120,10,'  ',0,0,'C');
            $this->Ln('5');
            $this->Ln('5');
            $this->SetFont('Arial','',15);
            $this->SetTextColor(26,35,126);
            $this->Cell(30);
           // $this->Cell(120,10,'Q . F . B',0,0,'C');    
            $this->Cell(120,10,'',0,0,'C');    
            $this->Ln('5');
            $this->Ln('5');
            $this->SetFont('Arial','B',11);
            $this->SetTextColor(26,35,126);
            $this->Cell(30);
            //$this->Cell(120,10,'R.F.C TETF 590906-8D4  CED. PROF. 1037451  TEL. 231-92-52 CELS. 22-23-98-11-94, 22-23-98-11-98',0,0,'C');
            $this->Ln(20);
       }
       // El pie del pdf
       public function Footer()
       {
           $this->SetY(-25);
           $this->SetFont('Arial','I',8);
           $this->SetFont('Arial', '', 12);
          $this->MultiCell(0,6,"\n",0,'C');
          $this->MultiCell(0,6,"ATENTAMENTE",0,'C');

           $this->SetTextColor(26,35,126);
           //$this->MultiCell(0,6,'R.F.C TETF 590906-8D4  CED. PROF. 1037451  TEL. 231-92-52 CELS. 22-23-98-11-94, 22-23-98-11-98',0,'C');
           //$this->Cell(0,10,iconv('UTF-8', 'windows-1252',"Página").$this->PageNo().'/{nb}',0,0,'C');
           

      }
    }