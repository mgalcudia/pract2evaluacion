<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."third_party/fpdf/fpdf.php";

class pdf extends FPDF{
    
        //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
        public function __construct($datosPedido = NULL) {
            parent::__construct();
			$this->pedido = $datosPedido;
        }
        
        
       public function Header(){
           
           /*
		    $this->SetFont('Arial','B',13);
            $this->Cell(30);
            $this->Cell(120,10,'Tienda Virtual',0,0,'C');
            $this->Ln('5');
            $this->SetFont('Arial','B',8);
            $this->Cell(30);
            //$this->Cell(120,10,'INFORMACION DE CONTACTO',0,0,'C');
            $this->Image('imagenes/logo_factura/mylogo.jpg',180,8,22);
             
            $this->Ln(20);
			*/
			
		$fecha_pedido = new DateTime($this->pedido['fecha_pedido']);
        
        $this->SetLeftMargin(15);
        $this->SetRightMargin(15);
        $this->SetFillColor(200, 200, 200);
        $this->SetFont('Arial', '', 25);
        $this->Image('imagenes/logo_factura/mylogo.jpg',15,8,22);
        $this->SetY(15);
        $this->SetX(-80);
        $this->Cell(65, 15, 'Tienda Virtual', '', 0, 'R');
        $this->Ln(21);
        if ($this->PageNo() == 1) {
            $this->SetFont('Arial', 'I', 8);
            $this->SetY(38);
            $this->SetX(15);
            $this->Cell(80, 7, "Vendedor:", 0, 1, 'L', 0);
            $this->SetY(38);
            $this->SetX(-95);
            $this->Cell(80, 7, "Comprador:", 0, 1, 'L', 0);
            $this->SetFont('Arial', 'I', 10);
            $this->SetY(45);
            $this->SetX(15);
            $this->MultiCell(80, 7, "Tienda Virtual \nCIF A28120368", 'TBLR', 'C', '1');
            $this->SetY(45);
            $this->SetX(-95);
            $this->SetFont('Arial', 'I', 8);
            $this->SetFont('Arial', 'I', 10);
            $this->MultiCell(80, 7, "{$this->pedido['nombre']} {$this->pedido['apellidos']} \nDNI {$this->pedido['dni']}", 'TBLR', 'C', '1');
            $this->Ln(14);
        }
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(15, 7, "Referencia: {$this->pedido['id']}", '', 0, 'L', 0);
            $this->SetX(-115);
        $this->Cell(100, 7, "Fecha: " . $fecha_pedido->format("d-m-Y") . "   Hora: " . $fecha_pedido->format("H:i:s"), '', 1, 'R', 0);
        $this->Cell(15, 7, utf8_decode('Número'), 'TBL', 0, 'C', '1');
        $this->Cell(85, 7, 'Producto', 'TB', 0, 'C', '1');
        $this->Cell(20, 7, 'Precio', 'TB', 0, 'C', '1');
        $this->Cell(20, 7, 'Cantidad', 'TB', 0, 'C', '1');
        $this->Cell(20, 7, 'Descuento', 'TB', 0, 'C', '1');
        $this->Cell(20, 7, 'Total', 'TBR', 0, 'C', '1');
        $this->Ln(7);
       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      } 
    
    
}