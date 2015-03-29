<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(__DIR__ . '/mi_controlador.php');

class carrito extends mi_controlador{
    
    
    function __construct() {
        parent::__construct();
    }
    
    
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

}
