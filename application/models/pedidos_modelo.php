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
    
    
    
    function usuario_pedidos($usuario){
        
        $this->db->where('cliente_id',$usuario);
        if($resultado = $this->db->get('pedido')){
            return $resultado->result_array();
            
        }  else {
            return false;
        }
     }
     
     
     /**
      *  funcion para modificar el estado de un pedido
      * @param type $id
      * @return boolean
      */
     function modificar_estado_pedido($id,$estado){
         
         $this->db->where('id', $id);
         var_dump($estado);
        if($this->db->update('pedido', $estado)){
            return true;
            
        }  else {
        
            return false;
        }
         
     }
     
     
    function lista_productos_pedido($pedido_id) {
        $this->db->where("pedido_id", $pedido_id);
        $resultado = $this->db->get("linea_pedido");
       /* foreach ($resultado->result() as &$r) {
            $producto = $this->productos_model->listar_producto($r->producto);
            $r->nombre = $producto->nombre;
            $r->descuento = $producto->descuento;
            $r->iva = $producto->iva;
        }*/
        
   //  print_r($resultado->result_array());
        return $resultado->result_array();
    }
     
     
    
    
     /**
      * fin
      */
}



