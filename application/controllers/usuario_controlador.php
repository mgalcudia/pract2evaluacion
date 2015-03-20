<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class usuario_controlador extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    /**
     * Carga la plantilla html (encabezado, menu, cuerpo y pie).
     * @param unknown $cuerpo
     */
    /*  protected function plantilla($cuerpo) {
      if (isset($this->session->userdata['valido'])) {
      $sesion = $this->session->userdata['valido'];

      //Carga del encabezado
      $encabezado = $this->load->view('header', $sesion, TRUE);
      } else {
      //Carga del encabezado
      $encabezado = $this->load->view('header', '', TRUE);
      }

      $pie = $this->load->view('footer', '', TRUE);

      //Creo una plantilla con los apartados a mostrar
      $this->load->view('plantilla', array(
      'encabezado' => $encabezado,
      'menu_izq' => '',
      'cuerpo' => $cuerpo,
      'pie' => $pie
      ));
      }

     */

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
            /* $this->plantilla(
              $this->load->view('registro_form', array('provincias' => $provincias), TRUE)); */
            $menuizq = $this->load->view('menuinzquierdo');
            $formulario = $this->load->view('formulario_registro', $data, TRUE);
            $this->load->view('plantilla', array(
                'encabezado' => '<p>Hola</p>',
                'menu_izq' => $menuizq,
                'cuerpo' => $formulario,
                'pie' => ''
            ));
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
            $menuizq = $this->load->view('menuinzquierdo');
            $formulario = $this->load->view('login', '', TRUE);
            $this->load->view('plantilla', array(
                'encabezado' => '<p>encabezado</p>',
                'menu_izq' => $menuizq,
                'cuerpo' => $formulario,
                'pie' => '<p>pie</p>'
            ));
        } else {

            $usuario = $this->input->post('usuario');
            $password = $this->input->post('password');

            if ($this->clientes_modelo->loginok($usuario, $password)) {

                $sess_array = array('usuario' => $this->input->post('usuario'));
                
                $this->session->set_userdata('valido', $sess_array);
                
                $result = $this->clientes_modelo->infousuario($sess_array);
                var_dump($result);
                if ($result != false) {
                    $data = array(
                        'nombre' => $result->nombre,
                        'usuario' => $result->usuario,
                        'email' => $result->email,
                        'password' => $result->password
                    );
                //TODO: Falta enviar a alguna vista 
                } else {

                    $data = array(
                        'mensaje_error' => 'usuario incorrecto'
                    );
                    
                }
                $this->load->view('login', $data, TRUE);
            }
        }
    }

    /**
	 * Cerrar sesión usuario
	 */
	public function logout() {
	
		//Borra los datos de la sesion
		$sess_array = array (
				'usuario' => ''
		);
		
		$this->session->unset_userdata('valido', $sess_array);
		
		$data['logout'] = 'Sesión cerrada.';
		
		//redirect('tienda/destacados');
		$this->$this->load->view('login', $data, TRUE);
	}
	
    
    
    
    
}
