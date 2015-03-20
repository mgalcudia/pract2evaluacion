<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Clientes_modelo extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     *  Función para insertar clientes
     * @param type $data array de datos
     */
    function insertar_cliente ($data){

       $this->db->insert('cliente',$data);

    }

         /**
     * Eliminar el cliente con id=$id
     * @param type $id
     */
    function borra_client($id){
        $this->db->where('id', $id);
        $this->db->delete('cliente');
    }

    /**
     * Comprobar si el usuario existe
     */

    function existe_usuario($data){

       $this->db->where('id',$data);
       $consulta= $this->db->get('cliente');

       if($consulta->result()){

           return true;

       }else{
           return false;
       }

    }

        /**
     * Busca clientes por diversos criterios
     * recogidos en $datos
     * @param type $datos
     * @return type
     */
    function buscar_clientes($datos){
        $this->db->where($datos);
        $query = $this->db->get('cliente');
        return $query->result_array();
    }

     /**
     * Obtener los clientes registrados en la base de datos
     * @return array
     */
    function lista_clientes(){
        $query = $this->db->get('cliente');

        return $query->result_array();
    }


    /**
     * Obtiene los clientes activos
     * @return type
     */
    function clientes_activos(){
        $this->db->where('activo', 'a');
        $query = $this->db->get('cliente');

        return $query->result_array();
    }

     /**
     * Dar de baja el cliente con id=$id
     * pero no lo elimina
     * @param type $id
     */
    function baja_cliente($id){
        $datos = array(
            'activo' => 'b'
        );
        $this->db->where('id', $id);
        $this->db->update('cliente', $datos);
    }



     /**
     * Edita los datos del cliente con id=$id
     * actualizando sus datos con $datos
     * @param type $id
     * @param type $datos
     */
    function editar_cliente($id, $datos){
        $this->db->where('id', $id);
        $this->db->update('cliente', $datos);
    }



    function loginok($usuario, $password)
	{
		$sql = "select * from cliente where usuario = '".$usuario."' AND password = '".$password."'";

		$query = $this->db->query($sql);

		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}



    	// Read data from database to show data in admin page
	public function infousuario($sess_array) {
		$condition = "usuario =" . "'" .$sess_array['usuario']. "'";

		$this->db->from ( 'cliente' );
		$this->db->where ( $condition );
		$this->db->limit ( 1 );
		$query = $this->db->get ();

		if ($query->num_rows () == 1)
		{
			return $query->row ();
		}
		else
		{
			return false;
		}
	}






}