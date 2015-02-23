<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Inicio extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('provincias_modelo');
    }
    
    public function index(){
          /*  $data['provincia']= $this->provincias_modelo->Nombre_Provincia('01');
       // echo $this->provincias_modelo->Nombre_Provincia('01');
          // $this->load->view('plantilla',$data);
           
           $data['provincias']= $this->provincias_modelo->Listar_Provincias();
           
           $this->load->view('plantilla',$data);*/
       // $this->load->view('welcome_message');
    }
    
    
    
    
}