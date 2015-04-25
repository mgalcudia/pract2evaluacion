<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(APPPATH . '/libraries/JSON_WebServer_Controller.php');

class Agregador extends JSON_WebServer_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->RegisterFunction('Total()', 'Devuelve el número de elementos que tenemos en la tienda');
        $this->RegisterFunction('Lista(offset, limit)', 'Devuelve una lista de productos de tamaño máximo [limit] comenzando desde la posición desde [offset]');
    }

    public function Total() {
        return $this->productos_model->total_destacados();
    }

    public function Lista($offset, $limit) {
        $destacados = $this->productos_model->listar_destacados($offset, $limit);
        
        foreach ($destacados as $clave => $valor) {
            $lista[] = [
                'nombre' => $valor["nombre"],
                'descripcion' => $valor["descripcion"],
                'precio' => $valor["precioVenta"],
                'img' => base_url().$valor['imagen'],
                'url' => site_url('/productos/muestra_producto/' .$valor['id'])
            ];
        }
        return $lista;
    }
}
