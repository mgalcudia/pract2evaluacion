<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."third_party/fpdf/fpdf.php";

class pdf extends FPDF{
    
        //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
        public function __construct() {
            parent::__construct();
        }
        
        
       public function Header(){
           
            $this->SetFont('Arial','B',13);
            $this->Cell(30);
            $this->Cell(120,10,'Tienda Virtual',0,0,'C');
            $this->Ln('5');
            $this->SetFont('Arial','B',8);
            $this->Cell(30);
            //$this->Cell(120,10,'INFORMACION DE CONTACTO',0,0,'C');
            $this->Image('imagenes/logo_factura/mylogo.jpg',180,8,22);
             
            $this->Ln(20);
       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      } 
    
    
}