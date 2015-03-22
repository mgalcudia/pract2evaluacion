<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class productos extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
   
    function pro_destacados($inicio=0){
        
         $total_pagina=3;
         $total_destacados= $this->productos_model->total_destacados();
         
         $config['base_url']= site_url('productos/pro_destacados');
         $config['total_rows']= $total_destacados;
         $config['per_page'] = $total_pagina;
         $this->pagination->initialize($config);

         
        $productos= $this->productos_model->listar_destacados($inicio,$total_pagina);
        $datas['paginador']= $this->pagination->create_links();
        $datas['titulo']= "<h1>Productos Destacados</h1>";
        
        $datas['productos']= $productos;
        
        //var_dump($productos);
        $datos['encabezado'] = $this->load->view("encabezado", array(
        'titulo' => 'Tienda online'
        ), TRUE);

      $datos['pie'] = $this->load->view("pie", 0, TRUE);
       
        $datos['cuerpo'] = $this->load->view('destacados', $datas, TRUE);
      $this->load->view('plantilla', $datos);
        
        
    }
    
    
}