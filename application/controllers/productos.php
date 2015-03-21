<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class productos extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
   
    function pro_destacados(){
        
        $productos= $this->productos_model->listar_destacados();
        $datas['titulo']= "<h1>Productos Destacados</h1>";
        
        $datas['productos']= $productos;
        
        //var_dump($productos);
        $datos['encabezado'] = $this->load->view("encabezado", array(
        'titulo' => 'Tienda online'
        ), TRUE);

      $datos['pie'] = $this->load->view("pie", 0, TRUE);
       
        $datos['cuerpo'] = $this->load->view('categorias', $datas, TRUE);
      $this->load->view('plantilla', $datos);
        
        
    }
    
    
}