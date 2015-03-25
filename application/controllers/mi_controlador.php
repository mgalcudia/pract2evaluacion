<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require(__DIR__.'/mi_controlador.php'),
class mi_controlador extends CI_Controller{
    
    
    /**
     * Carga la plantilla html (encabezado, menu, cuerpo y pie).
     * @param unknown $cuerpo
     */
    protected function plantilla($cuerpo){
         $categ['categoria'] = $this->categorias_modelo->todas_categorias();
  
        $encabezado= $this->load->view("encabezado",$categ , TRUE);
        
        $pie= $this->load->view("pie", 0, TRUE);
        
        //Creo una plantilla con los apartados a mostrar
        $this->load->view('plantilla', array(
            'encabezado' => $encabezado,
            'cuerpo' => $cuerpo,
            'pie' => $pie
            ));
    }
    
    
    
    
    
    
    
}

