<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require(__DIR__ . '/mi_controlador.php');

class usuario_controlador extends mi_controlador {

    function __construct() {
        parent::__construct();
    }

    function registrousuario() {

        //obtener provincias para listarlas
        // $provincia= $this->provincias_modelo->Listar_Provincias();
        $data['provincias'] = $this->provincias_modelo->Listar_Provincias();
        //reglas de validacion

        $this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required|matches[pConfirm]|md5');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'trim|required');
        $this->form_validation->set_rules('dni', 'dni', 'trim|required|exact_length[9]|callback_validarDNI');
        $this->form_validation->set_rules('direccion', 'direccion', 'trim|required');
        $this->form_validation->set_rules('codpostal', 'código postal', 'trim|required|numeric|exact_length[5]');
        $this->form_validation->set_rules('pConfirm', 'confirma contraseña', 'trim|required');

        //da formato a los errores
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        if ($this->form_validation->run() == FALSE) {
           
            $cuerpo = $this->load->view('formulario_registro', $data, TRUE);
            $this->plantilla($cuerpo);
            
        } else {
            $datos['nombre'] = $this->input->post('nombre');
            $datos['apellidos'] = $this->input->post('apellidos');
            $datos['dni'] = $this->input->post('dni');
            $datos['direccion'] = $this->input->post('direccion');
            $datos['codpostal'] = $this->input->post('codpostal');
            $datos['provincia_id'] = $this->input->post('selprovincias');
            $datos['usuario'] = $this->input->post('usuario');
            $datos['email'] = $this->input->post('email');
            $datos['password'] = $this->input->post('password');

            echo "<pre>";
            print_r($datos);
            echo "</pre>";

            var_dump($_POST['selprovincias']);
            $this->clientes_modelo->insertar_cliente($datos);
            //$this->plantilla(
            //$this->load->view('exito', '', TRUE));
        }
    }

    /**
     * Valida el campo DNI
     * @param unknown $str
     * @return boolean
     */
    public function validarDNI($str) {
        $str = trim($str);
        $str = str_replace("-", "", $str);
        $str = str_ireplace(" ", "", $str);

        if (!preg_match("/^[0-9]{7,8}[a-zA-Z]{1}$/", $str)) {

            return FALSE;
        } else {
            $n = substr($str, 0, -1);
            $letter = substr($str, -1);
            $letter2 = substr("TRWAGMYFPDXBNJZSQVHLCKE", $n % 23, 1);
            if (strtolower($letter) != strtolower($letter2))
                return FALSE;
        }
        return TRUE;
    }

    /**
     *  funcion para loguear usuario
     */
    function loguearse() {

        $this->form_validation->set_rules('usuario', 'usuario', 'trim|required|min_length[3]|max_length[25]|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'trim|required|md5');

        if ($this->form_validation->run() == FALSE) {

            if (!$this->session->userdata('usuario')){
                 $cuerpo= $this->load->view('login', '', TRUE);

            $this->plantilla($cuerpo);
                
            }else{
                redirect(site_url());
            }
           
            
        } else {            
            $usuario = $this->input->post('usuario');
            $password = $this->input->post('password');
           
            if ($this->clientes_modelo->loginok($usuario, $password)==true) {                                  
                
                  $this->session->set_userdata('usuario', $usuario);
                $usu= $this->session->all_userdata();
                
               
                var_dump($usu);
                    if($this->session->userdata('finalizar_compra')){                        
                        redirect(site_url('carrito/mostrar_carro'));
                    }else{
                        redirect(site_url());
                    }
            }else{
            $data['mensaje_error' ]= "<h1>Usuario incorrecto</h1>";
                    
                 $cuerpo= $this->load->view('login', $data, TRUE);
               $this->plantilla($cuerpo); 
            }
        }
    }

    /**
     * Cerrar sesión usuario
     */
    public function salir() {

        if($this->session->userdata('usuario')){
            
            $this->session->unset_userdata('usuario');
            
            
        }else{
            
            redirect(site_url());
            
        }
        
    }

}
