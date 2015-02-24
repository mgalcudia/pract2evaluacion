<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
        
    /**
     * Devuelve el nombre de una provincia con id=$id
     * @param type $id
     * @return string
     */
    function nombre_categoria($id){
        $this->db->where('id', $id);
        $query = $this->db->get('categoria');
        
        $reg= $query->row(); // row(): Devuelve el primer registro
        if ($reg){
            return $reg->nombre;
        }else{
            return '';
        }  
    }
    
    
    /**
     * obtener todos los productos de la tienda
     * @return type
     */
    function todas_categorias(){
        $query = $this->db->get('categoria');
        return $query->result_array();
    }
    
    /**
     * nueva categoría
     * @param type $datos
     */
    function crear_categoria($datos){
        $this->db->insert('categoria', $datos);
    }

    
    /**
     * Busca categorías por $datos
     * @param type $datos
     * @return type
     */
    function busca_categorias($datos){
        $this->db->where($datos);
        $query = $this->db->get('categoria');
        return $query->result_array();
    }
}


