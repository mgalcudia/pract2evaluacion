<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require(__DIR__ . '/mi_controlador.php');

class carrito extends mi_controlador {

    function __construct() {
        parent::__construct();
    }

    /**
     * Agrega productos seleccionados al carrito
     */
    function agregar_carrito() {

        // var_dump($_POST);

        $id_producto = $this->input->post('id_producto');
        $producto = $this->productos_model->obten_producto($id_producto);
        $cantidad = 1;
        //obtenemos el contenido del carrito
        $carrito = $this->cart->contents();
        //var_dump($producto);
        foreach ($carrito as $item) {
            //si el id del producto es igual que uno que ya tengamos
            //en la cesta le sumamos uno a la cantidad
            if ($item['id'] == $id_producto) {
                $cantidad = 1 + $item['qty'];
            }
        }

        $datos = array(
            'id' => $id_producto,
            'qty' => $cantidad,
            'price' => $producto['precioVenta'],
            'name' => $producto['nombre'],
            'stock' => $producto['cantidad'],
            'descuento' => $producto['descuento'],
            'iva' => $producto['iva'],
            'precio_final' => $this->calcular_precio($producto['precioVenta'], $producto['descuento'])
        );
        $this->cart->insert($datos);
        $this->session->set_flashdata('informe', $datos['name'].' fue agregado correctamente');

        redirect($this->input->post('url'));
        //var_dump($producto);
    }

    /**
     * 
     * @param type $rowid
     */
    function eliminarProducto($rowid) {
        //para eliminar un producto en especifico lo que hacemos es conseguir su id
        //y actualizarlo poniendo qty que es la cantidad a 0
        $producto = array(
            'rowid' => $rowid,
            'qty' => 0
        );
        //después simplemente utilizamos la función update de la librería cart
        //para actualizar el carrito pasando el array a actualizar
        $this->cart->update($producto);

        $this->session->set_flashdata('productoEliminado', 'El producto fue eliminado correctamente');
        redirect('carrito/mostrar_carro');
    }

    /*
     * vacia el carrito de la compra
     */

    function eliminar_carrito() {
        $this->cart->destroy();
        $this->session->set_flashdata('destruido', 'El carrito fue eliminado correctamente');
        redirect('carrito/mostrar_carro'); //mandar al carrito
    }

    /**
     * Calcula el precio final 
     * @param  [type]  $precio [description]
     * @param  integer $desc   [description]
     * @return [type]          [description]
     */
    function calcular_precio($precio, $desc = 0) {
        return floatval($precio - ($precio * $desc / 100));
    }

    function mostrar_carro() {

        $datas['productos'] = $this->cart->contents();
        $datas['precio'] = $this->cart->total();
        //var_dump($datas);



        $cuerpo = $this->load->view('productos_carro', $datas, TRUE);

        $this->plantilla($cuerpo);
    }

    function finalizar_compra() {

        $total_productos = $this->cart->total_items();
        $productos_sin_existencias = $this->comprobar_stock();
        $detalle_pedido = $this->input->post('detalle_pedido');
        $productos_carrito = $this->cart->contents();
        //si no esta logeado lo mandamos a logearse
      if (!$this->session->userdata('usuario')) { 
          
          $this->session->set_userdata('finalizar_compra');
          redirect(site_url('usuario_controlador/loguearse'));
            
    }else{
           if($total_productos == 0) { //si no ha pedidos muestra el carrito vacio
            $datas['ruta'] = base_url('assets/fonts/carro_vacio.png');
            $cuerpo = $this->load->view('carrito_vacio', $datas, TRUE);
            $this->plantilla($cuerpo);
        } elseif (count($productos_sin_existencias) > 0) { //informa si no hay existencias de productos
            $datas['productos'] = $productos_sin_existencias;
            $cuerpo = $this->load->view('productos_sin_existencias', $datas, TRUE);
            $this->plantilla($cuerpo);
        } else {

            if ($detalle_pedido) {

                $datos_pedido = $this->datos_pedido();
                //var_dump($datos_pedido);
                $pedido_id = $this->pedidos_modelo->crear_pedido($datos_pedido);
                //var_dump($productos_carrito);
                foreach ($productos_carrito as $producto) {

                    $pedido = array(
                        'producto_id' => $producto['id'],
                        'pedido_id' => $pedido_id,
                        'cantidad' => $producto['qty'],
                        'precio_venta' => $producto['price'],
                        'descuento' => $producto['descuento'],
                        'iva' => $producto['iva']
                    );
                    $almacenado = $this->productos_model->almacenado($producto['id']);

                    $almacen = $almacenado - $producto['qty'];
                    //var_dump($almacen);
                    //var_dump($datosLinea);*/
                    $this->productos_model->actualiza_almacen($producto['id'], $almacen);
                    $this->linea_pedido_modelo->crear_linea_pedido($pedido);
                }
                $this->cart->destroy();//vaciamos el carrito.
                $this->generar_factura($pedido_id); //generamos el pdf de la factura
                $this->mandar_correo($pedido_id);
                 $this->session->set_flashdata('informe', 'Compra realizada');
                    redirect(site_url());
            } else {

                $datas['productos'] = $productos_carrito;
                $datas['total'] = $this->cart->total();
                $cuerpo = $this->load->view('detalle_pedido', $datas, TRUE);
                $this->plantilla($cuerpo);
            }
        }
    }
    }

    function mandar_correo($pedido_id) {

        //obtenemos los datos del pedido
        $pedido = $this->pedidos_modelo->obten_pedido($pedido_id);
        print_r($pedido);
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';

        $this->email->initialize($config);

        $this->email->from('aula4@iessansebastian.com', 'Tienda Virtual');
        //$this->email->to('malcudia@gmail.com');
        $this->email->to($pedido['email']);

        $this->email->cc('malcudia@gmail.com');
        $this->email->subject('Factura Pedido ' . $pedido_id);
        $this->email->message('Gracias por su compra.');
        if (file_exists(APPPATH . "../pdf/" . "fact_" . $pedido_id . ".pdf")) {
            $this->email->attach(APPPATH . "../pdf/" . "fact_" . $pedido_id . ".pdf");
            return $this->email->send();
        }
    }

    /**
     *  funcion que genera el pdf de la factura
     * @param type $pedido_id
     */
    function generar_factura($pedido_id) {

        //obtenemos los datos del pedido
        $pedido = $this->pedidos_modelo->obten_pedido($pedido_id);
        //var_dump($pedido);
        //obtenemos los productos del pedido
        $linea_pedido = $this->linea_pedido_modelo->buscar_linea_pedidos(array(
            'pedido_id' => $pedido['id']
        ));
		
        /*
         * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
         * heredó todos las variables y métodos de fpdf
         */
        $this->pdf = new pdf($pedido);
        // Agregamos una página
        $this->pdf->AddPage();
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        /* Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
/*
        $this->pdf->SetTitle("Factura");
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(2,157,116); // color de relleno de la celda
        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdf->SetFont('Arial', 'B', 9);
        $this->pdf->Cell(120, 10, utf8_decode('Factura Nº: ' . $pedido_id), 0, 0, 'C');
        $this->pdf->Ln(5);
        $this->pdf->Cell(30);
        $this->pdf->Cell(120, 10, 'Datos personales', 0, 0, 'C');
        $this->pdf->Ln(12);

        // $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);

        foreach ($pedido as $campo => $valor) {
            $this->pdf->Cell(30);
            $this->pdf->Cell(38, 7, utf8_decode($campo), 'TBL', 0, 'L', '1');
            $this->pdf->Cell(50, 7, utf8_decode($valor), 'TBLR', 0, 'L', '1');
            $this->pdf->Ln(7);
        }


        $this->pdf->Ln(7);

        $this->pdf->Cell(30);
        $this->pdf->Cell(120, 10, 'Productos comprados', 0, 0, 'C');
        $this->pdf->Ln(12);


        foreach ($linea_pedido as $numero => $linea) {
            $id_producto = $linea['producto_id'];
            $producto = $this->productos_model->obten_producto($id_producto);

            $linea_pedido[$numero]['nombre_producto'] = utf8_decode($producto['nombre']);
        }
        // print_r($articulo);
        foreach ($linea_pedido as $linea) {
            foreach ($linea as $key => $value) {
                $this->pdf->Cell(30);
                $this->pdf->Cell(38, 7, $key, 'TBL', 0, 'L', '0');
                $this->pdf->Cell(50, 7, $value, 'TBLR', 0, 'L', '0');
                $this->pdf->Ln(7);
            }

            $this->pdf->Ln(1);
        }
		*/
		
        $this->pdf->SetTitle("Factura " . $pedido['id']);
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(200, 200, 200);

        $this->pdf->SetFont('Arial', 'B', 9);

        $x = 1;
        $subtotal = 0;
        $iva = 0;
        foreach ($linea_pedido as $l) {
			$producto = $this->productos_model->obten_producto($l['producto_id']);
            $this->pdf->Cell(15, 7, $x++, 'BL', 0, 'C', '0');
            $this->pdf->Cell(85, 7, utf8_decode($producto['nombre']), 'B', 0, 'C', '0');
            $this->pdf->Cell(20, 7, $l['precio_venta'] . iconv('UTF-8', 'windows-1252', " €"), 'B', 0, 'C', '0');
            $this->pdf->Cell(20, 7, $l['cantidad'], 'B', 0, 'C', '0');
            $this->pdf->Cell(20, 7, $l['descuento'] . iconv('UTF-8', 'windows-1252', "%"), 'B', 0, 'C', '0');
            $total = ($l['precio_venta'] * $l['cantidad'] - ($l['precio_venta'] * $l['cantidad'] * ($l['descuento'] / 100)));
            $subtotal += $total;
            $this->pdf->Cell(20, 7, round($total, 2) . iconv('UTF-8', 'windows-1252', " €"), 'BR', 0, 'C', '0');
            $this->pdf->Ln(7);

            $iva += $total * ($l['iva'] / 100);
        }
        $this->pdf->Ln(7);
        $this->pdf->setX(155);
        $this->pdf->Cell(20, 7, "Subtotal", '', 0, 'R', '1');
        $this->pdf->Cell(20, 7, round($subtotal, 2) . iconv('UTF-8', 'windows-1252', " €"), 'B', 1, 'C', '0');
        $this->pdf->setX(155);
        $this->pdf->Cell(20, 7, "IVA", 'T', 0, 'R', '1');
        $this->pdf->Cell(20, 7, round($iva, 2) . iconv('UTF-8', 'windows-1252', " €"), 'B', 1, 'C', '0');
        $this->pdf->setX(155);
        $this->pdf->Cell(20, 7, "Total", 'TB', 0, 'R', '1');
        $this->pdf->Cell(20, 7, round($subtotal + $iva, 2) . iconv('UTF-8', 'windows-1252', " €"), 'B', 1, 'C', '0');


        //Podemos mostrar con I, descargar con D, o guardar con F
        //$this->pdf->Output($pedido['id'].".pdf", 'I');
        //$this->pdf->Output("Lista de provincias.pdf", 'D');
        $this->pdf->Output(APPPATH . "../pdf/fact_" . $pedido['id'] . ".pdf", 'F');
    }

    /**
     * funcion para crear los datos del pedido
     * @return array de pedido
     */
    function datos_pedido() {


        //TODO: datos del cliente a modificar cuando termine el loguin,
        // mientras los genero directamente
       // $usuario['usuario'] = 'usuario2';  $this->session->userdata('usuario')
        $usuario['usuario']=$this->session->userdata('usuario');
        $cliente = $this->clientes_modelo->datos_cliente($usuario);

        $pedido = array(
            'cliente_id' => $cliente['id'],
            'nombre' => $cliente['nombre'],
            'apellidos' => $cliente['apellidos'],
            'email' => $cliente['email'],
            'dni' => $cliente['dni'],
            'direccion' => $cliente['direccion'],
            'provincia' => $cliente['provincia_id'],
            'codpostal' => $cliente['codpostal'],
            'cantidad' => $this->cart->total_items(),
            'importe' => $this->cart->total(),
            'fecha_pedido' => date('Y-m-d')
        );
        //var_dump($pedido);
        return $pedido;
    }

    /**
     * comprueba que los productos del carrito esten en stock
     * 
     * @return array 
     */
    function comprobar_stock() {

        $articulos = [];
        $productos = $this->cart->contents();


        foreach ($productos as $producto) {
            if ($producto['qty'] > $this->productos_model->coprobar_stock($producto['id'])) { //No hay stock suficiente
                array_push($articulos, $producto['name']);
            }
        }
        return $articulos;
    }

    /*
     * fin 
     */
}
