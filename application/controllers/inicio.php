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
          /*  $data['provincia']= $this->provincias_modelo->Nombre_Provincia('01');
       // echo $this->provincias_modelo->Nombre_Provincia('01');
          // $this->load->view('plantilla',$data);
           
           $data['provincias']= $this->provincias_modelo->Listar_Provincias();
           
           $this->load->view('plantilla',$data);*/
        //$this->load->view('welcome_message');
        
       // $datos['provincias']=$this->provincias_modelo->Listar_Provincias();
      // $this->load->view('formulario_registro',$datos);
       // echo base_url("index.php/usuario_controlador/registrousuario");
       // echo site_url("index.php/usuario_controlador/registrousuario");
       $parametros= ["enlace"=>anchor('usuario_controlador/registrousuario','Registrar usuario'),
                        ];
        $this->load->view("vista", $parametros);
      
    }
    
    
    
    
}