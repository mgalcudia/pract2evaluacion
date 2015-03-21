<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Inicio extends CI_Controller{
    
    function __construct() {
        parent::__construct();
       
        $this->load->model('provincias_modelo');
    }
    
    function index(){
      $datos['encabezado'] = $this->load->view("encabezado", array(
        'titulo' => 'Tienda online'
        ), TRUE);

      $datos['pie'] = $this->load->view("pie", 0, TRUE);
      $datos['cuerpo'] = $this->load->view("lorem", 0, TRUE);
      $this->load->view('plantilla', $datos);
    }
    
    
    
    
}