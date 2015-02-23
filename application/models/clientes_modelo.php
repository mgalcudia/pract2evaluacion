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
    function Insertar_cliente ($data){
        
       $this->db->insert('cliente',$data);
            
    }
    
    /**
     * Funcion para comprobar si el usuario existe
     */
    
    function Existe_Usuario($data){
        
       $this->db->where('id',$data);
       $consulta= $this->db->get('cliente');
       
       if($consulta->result()){
           
           return true;
           
       }else{
           return false;
       }      
        
    }
    
    
    
    
    
    
    
    
    
    
    
}