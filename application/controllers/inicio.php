<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require(__DIR__.'/mi_controlador.php');
class Inicio extends mi_controlador{
    
    function __construct() {
        parent::__construct();
       
        $this->load->model('provincias_modelo');
    }
    
    function index($inicio=0){
   
        //parametros para el paginador
        $url= site_url('productos/pro_destacados');
        $total_pagina=6;
        $total_filas= $this->productos_model->total_destacados();
          
           //llamada al paginador      
        $datas['paginador']= $this->paginador($url,$total_pagina,$total_filas); 
        
        $datas['titulo']= "<h1>Productos Destacados</h1>";
        
        $datas['productos']= $this->productos_model->listar_destacados($inicio,$total_pagina); 
        
        $cuerpo = $this->load->view('destacados', $datas, TRUE);    
        
        $this->plantilla($cuerpo);
        
    }
    
    
    
    
}