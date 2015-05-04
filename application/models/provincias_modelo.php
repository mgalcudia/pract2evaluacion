<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class provincias_modelo extends CI_Model {

     function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     *  Función para obtener una provincia según su id
     * @param type id de la provincia
     * @return nombre de la provincia
     */
    function nombre_provincia($id) {

        $this->db->select("nombre");
        $this->db->where("id",$id);
        $resultado = $this->db->get("provincia");
        return $resultado->row()->nombre;
    }
    
    /**
     *  Función para listar las provincias
     * 
     * @return array con las provincias y sus Id
     */
    public function listar_provinciasTodo(){
        
       $resultado= $this->db->get("provincia");
        
        return $resultado-> result_array();
        
    }
      
        public function listar_provincias(){
        
      $resultado = "select * from provincia";
		$resultado = $this->db->query($resultado);
	
		if($resultado->num_rows()>0)
		{
			foreach ($resultado->result() as $fila)
			{
				$provincias[$fila->id] = $fila->nombre;
				$resultado->free_result();
			}
			return $provincias;
		}
        
    }

}
