<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class productos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Lista todos los productos de la tienda
     * @return type
     */
    function listar_productos() {
        $query = $this->db->get('producto');
        return $query->result_array();
    }

    /**
     * Busca productos por categorias
     * recogidos en $datos
     * @param type $datos
     * @return type
     */
    function buscar_productos($datos, $inicio = 0, $limit = 0) {

        $this->db->from('producto');
        $this->db->limit($limit, $inicio);
        $this->db->where('oculto', 1);
        $this->db->where('categoria_id', $datos);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * total productos por categorias
     * @return type
     */
    function total_product_categoria($datos) {

        $this->db->from('producto');
        $this->db->where('oculto', 1);
        $this->db->where('categoria_id', $datos);
        $resultado = $this->db->get();
        return $resultado->num_rows();
    }

    /**
     * Vende una cantidad $cant de unidades 
     * del producto $id
     * @param type $id
     * @param type $cant
     */
    function vender_producto($id, $cant) {
        $this->db->where('id', $id);
        $datos = array('stock' => $cant);
        $this->db->update('producto', $datos);
    }

    /**
     * Crea un nuevo producto
     * @param type $datos
     */
    function crear_producto($datos) {
        $this->db->insert('producto', $datos);
    }

    /**
     * Edita los datos de un producto
     * @param type $id
     * @param type $datos
     */
    function editar_producto($id, $datos) {
        $this->db->where('id', $id);
        $this->db->update('producto', $datos);
    }

    /**
     * Destaca el producto con id=$id
     * @param type $id
     */
    function destacar_producto($id) {
        $datos = array(
            'destacado' => 1
        );
        $this->db->where('id', $id);
        $this->db->update('producto', $datos);
    }

    /**
     * lista los productos destacados
     */
    function listar_destacados($inicio = 0, $limit = 0) {
        $this->db->limit($limit, $inicio);
        $this->db->from('producto');
        $where = '(fec_inicio_desta < ' . date("Y-m-d") . ' AND fec_fin_desta > ' . date("Y-m-d") . ') OR ';
        $where.= '(fec_inicio_desta is null AND fec_fin_desta is null AND destacado like "1")';
        $this->db->where($where);
        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    function total_destacados() {

        $this->db->from('producto');
        $where = '(fec_inicio_desta < ' . date("Y-m-d") . ' AND fec_fin_desta > ' . date("Y-m-d") . ') OR ';
        $where.= '(fec_inicio_desta is null AND fec_fin_desta is null AND destacado like "1")';
        $this->db->where($where);
        $resultado = $this->db->get();
        return $resultado->num_rows();
    }

    function obten_producto($id) {

        $this->db->where(array('id' => $id));
        $query = $this->db->get('producto');

        return $query->row_array();
    }

    function comprobar_stock($id){        
         $this->db->select('cantidad');
        $this->db->where('id', $id);
        return $this->db->get('producto')->row_array()['cantidad'];
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
        function almacenado($id){
        $this->db->select('cantidad');
        $this->db->where('id', $id);
        return $this->db->get('producto')->row_array()['cantidad'];
    }
    
    
    
        function actualiza_almacen($id, $cantidad){
        $this->db->where('id', $id);
        $this->db->update('producto', array(
            'cantidad' => $cantidad
            ));
    }
    
}
