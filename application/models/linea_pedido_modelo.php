<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class linea_pedido_modelo extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Lista las lineas de pedidos
     * @return type
     */
    function listar_linea_pedidos(){
        $query = $this->db->get('linea_pedido');
        return $query->result_array();
    }
        
    
    /**
     * Crea un nuevo linea_linea_pedido
     * @param type $datos
     */
    function crear_linea_pedido($pedido){
        $this->db->insert('linea_pedido', $pedido);
    }
    /**
     * Busca lineas de pedido por $datos
     * @param type $datos
     * @return type
     */
    function buscar_linea_pedidos($datos){
        $this->db->where($datos);
        $query = $this->db->get('linea_pedido');
        return $query->result_array();
    }

    
}





