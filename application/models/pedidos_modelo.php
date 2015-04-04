<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pedidos_modelo extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Lista los pedidos
     * @return type
     */
    function listar_pedidos(){
        $query = $this->db->get('pedido');
        return $query->result_array();
    }
    
    /**
     * Crea un nuevo pedido
     * @param type $datos
     */
    function crear_pedido($datos){
     
        if($this->db->insert('pedido', $datos)){
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    /**
     * Busca pedidos por $datos
     * @param type $datos
     * @return type
     */
    function buscar_pedidos($datos){
        $this->db->where($datos);
        $query = $this->db->get('pedido');
        return $query->result_array();
    }
    
    /**
     * Busca un pedido por $datos
     * @param type $datos
     * @return type
     */
    function obten_pedido($datos){
        $this->db->where('id', $datos);       
        $query = $this->db->get('pedido');
        return $query->row_array();
    }
    
}



