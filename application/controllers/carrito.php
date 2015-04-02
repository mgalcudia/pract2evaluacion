<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(__DIR__ . '/mi_controlador.php');

class carrito extends mi_controlador{
    
    
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
        var_dump($producto);
        foreach ($carrito as $item) {
            //si el id del producto es igual que uno que ya tengamos
            //en la cesta le sumamos uno a la cantidad
            if ($item['id'] == $id_producto) {
                $cantidad = 1 + $item['qty'];
            }
        }
        
        $datos= array(
            
            'id' => $id_producto,
            'qty' => $cantidad,
            'price' => $producto['precioVenta'],
            'name' => $producto['nombre'],
            'stock'=>$producto['cantidad'],
            'descuento' => $producto['descuento'],
            'precio_final' => $this->calcular_precio($producto['precioVenta'], $producto['descuento'])
            );
        $this->cart->insert($datos); 
         $this->session->set_flashdata('agregado', 'El producto fue agregado correctamente');
      
        redirect($this->input->post('url'));
        var_dump($producto);
            
    }
    
    /**
     * 
     * @param type $rowid
     */
        function eliminarProducto($rowid) 
    {
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
        redirect('carrito/mostrar_carro');//mandar al carrito
    }
    
     /**
     * Calcula el precio final 
     * @param  [type]  $precio [description]
     * @param  integer $desc   [description]
     * @return [type]          [description]
     */
    function calcular_precio($precio, $desc=0){
        return floatval($precio - ($precio*$desc/100));
    }
    
    function mostrar_carro(){
        
        $datas['productos']= $this->cart->contents();
        $datas['precio']= $this->cart->total();        
        var_dump($datas);
        
        
        
        $cuerpo = $this->load->view('productos_carro', $datas, TRUE);    
        
        $this->plantilla($cuerpo);
    }

    
    function finalizar_compra(){
        
        $total_productos= $this->cart->total_items();
        var_dump($total_productos);
        if($total_productos==0){
            $datas['ruta']= base_url('assets/fonts/carrito-vacio.jpg');
            $cuerpo= $this->load->view('carrito_vacio',$datas,TRUE);
            $this->plantilla($cuerpo);            
        }
    }
        
        /**
         * comprueba que los productos del carrito esten en stock
         * 
         * @return array 
         */
        function comprobar_stock(){
            
        $articulos = [];
        $productos = $this->cart->contents();


        foreach ($productos as $producto) {
            if($producto['qty'] > $this->productos_model->coprobar_stock($producto['id']))
                { //No hay stock suficiente
            
                array_push($articulos, $articulo['name']);
            }
        }
        return $articulos;
            
         
        
    }
    
    
    
    /*
     * fin 
     */
    
}
