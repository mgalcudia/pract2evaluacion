<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require(__DIR__.'/mi_controlador.php'),
class Inicio extends CI_Controller{
    
    function __construct() {
        parent::__construct();
       
        $this->load->model('provincias_modelo');
    }
    
    function index($inicio=0){
    /*  $datos['encabezado'] = $this->load->view("encabezado", array(
        'titulo' => 'Tienda online'
        ), TRUE);

      $datos['pie'] = $this->load->view("pie", 0, TRUE);
      //$datos['cuerpo'] = $this->load->view("lorem", 0, TRUE);      
      $this->load->view('plantilla', $datos);
     */

         $total_pagina=6;
         $total_destacados= $this->productos_model->total_destacados();
         
         //$config['uri_segment'] = 7;
         $config['base_url']= site_url('productos/pro_destacados');
         $config['total_rows']= $total_destacados;
         $config['per_page'] = $total_pagina;
         $config['num_links'] = 2;
         $config['first_link'] = 'Primero';
         $config['last_link'] = 'Último';
         $config['full_tag_open'] = '<div id="paginacion">';//el div que debemos maquetar
         $config['full_tag_close'] = '</div>';//el cierre del div de la paginación
        
         $this->pagination->initialize($config);
        $datas['paginador']= $this->pagination->create_links();
         
        $productos= $this->productos_model->listar_destacados($inicio,$total_pagina);
        
        $datas['titulo']= "<h1>Productos Destacados</h1>";
        
        $datas['productos']= $productos;
        
         $categ['categoria'] = $this->categorias_modelo->todas_categorias();
  
        $datos['encabezado'] = $this->load->view("encabezado",$categ , TRUE);

      $datos['pie'] = $this->load->view("pie", 0, TRUE);
       
        $datos['cuerpo'] = $this->load->view('destacados', $datas, TRUE);
      $this->load->view('plantilla', $datos);
        
    }
    
    
    
    
}