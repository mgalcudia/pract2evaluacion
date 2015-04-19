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



            //  var_dump($_POST['selprovincias']);
            $this->clientes_modelo->insertar_cliente($datos);
            //$this->plantilla(
            //$this->load->view('exito', '', TRUE));
            redirect(site_url());
        }
    }

    /**
     * Valida el campo DNI
     * @param unknown $str
     * @return boolean
     */
    function validarDNI($str) {
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

            if (!$this->session->userdata('usuario')) {
                $cuerpo = $this->load->view('login', '', TRUE);

                $this->plantilla($cuerpo);
            } else {
                redirect(site_url());
            }
        } else {
            $usuario = $this->input->post('usuario');
            $password = $this->input->post('password');

            if ($this->clientes_modelo->loginok($usuario, $password) == true) {

                $this->session->set_userdata('usuario', $usuario);
                $usu = $this->session->all_userdata();


                // var_dump($usu);
                if ($this->session->userdata('finalizar_compra')) {
                    redirect(site_url('carrito/mostrar_carro'));
                } else {
                    redirect(site_url());
                }
            } else {
                $data['mensaje_error'] = "<h1>Usuario incorrecto</h1>";

                $cuerpo = $this->load->view('login', $data, TRUE);
                $this->plantilla($cuerpo);
            }
        }
    }

    /**
     * Cerrar sesión usuario
     */
    public function salir() {

        if ($this->session->userdata('usuario')) {


            $this->session->unset_userdata('usuario');
            redirect(site_url());
        } else {

            redirect(site_url());
        }
    }

    /**
     * dirige al panel donde el usuario podra modificar su perfil
     */
    function panel_control() {

        if ($this->session->userdata('usuario')) {

            $data['usuario']= $this->session->userdata('usuario');
            $cuerpo = $this->load->view('panel_control', $data, TRUE);
                $this->plantilla($cuerpo);
        } else {

            redirect(site_url());
        }
    }

    /**
     * modifica el password de un usuario por uno predefinido
     */
    function restablece_pass() {
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {

            $cuerpo = $this->load->view('restaurar_pass', '', TRUE);
            $this->plantilla($cuerpo);
        } else {
            $correo = $this->input->post('email');
            $consulta = $this->clientes_modelo->existe_mail($correo);
            if ($consulta) {

                $usuario = $consulta['usuario'];
                $mail['email'] = $consulta['email'];
                $pass['password'] = md5('123456');
                $id = $consulta['id'];

                if ($this->clientes_modelo->editar_cliente($id, $pass)) {

                    //mandamos el correo
                    $this->password_mail($usuario, $mail);
                    print_r($pass['password']);
                    //Iniciamos la sesion del usuario y lo enviamos al panel de control
                    if ($this->clientes_modelo->loginok($usuario, $pass['password']) == true) {
                        $this->session->set_userdata('usuario', $usuario);
                        redirect(site_url('usuario_controlador/panel_control'));
                    }
                } else {
                    //se produce un error
                    redirect(site_url('usuario_controlador/restablece_pass'));
                }
            } else {
                redirect(site_url('usuario_controlador/restablece_pass'));
            }
        }
    }

    
    /**
     * envia al usuario un correo informandole del la modificacion de su contraseña.
     * @param type $usuario
     * @param type $mail
     * @return type
     */
    function password_mail($usuario, $mail) {

        // Utilizando smtp
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';
        $config['mailtype'] = 'html';

 
        $this->email->initialize($config);

        $this->email->from('aula4@iessansebastian.com', 'Tienda Virtual');
        $this->email->to($mail['email']);
        $this->email->subject('Nuevo password');
        $this->email->message("<html><body><h2>Modifique la contraseña a una de su gusto</h2><p>Usuario:<font color='red'>" . $usuario .
                "</font></p><p>Nuevo password:<font color='red'> 123456</font></p></body></html>");
        return $this->email->send();
    }

    
    
    function editar(){
        $usuario= $this->session->userdata('usuario');
        
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
        
        $data['usuario']=$usuario;
         $data['datos']=  $this->clientes_modelo-> buscar_clientes($data)[0];
         $data['provincias'] = $this->provincias_modelo->Listar_Provincias();         
           
            print_r($data['datos']);
            if ($this->form_validation->run() == FALSE) {

            $cuerpo = $this->load->view('formulario_modificar', $data, TRUE);
            $this->plantilla($cuerpo);
        }else{
            $id=$this->input->post('id');
            $datos['nombre'] = $this->input->post('nombre');
            $datos['apellidos'] = $this->input->post('apellidos');
            $datos['dni'] = $this->input->post('dni');
            $datos['direccion'] = $this->input->post('direccion');
            $datos['codpostal'] = $this->input->post('codpostal');
            $datos['provincia_id'] = $this->input->post('selprovincias');
            $datos['usuario'] = $this->input->post('usuario');
            $datos['email'] = $this->input->post('email');
            $datos['password'] = $this->input->post('password');
            
            
            $this->clientes_modelo->editar_cliente($id, $datos);
        }
    }




    /*
     * fin del controlador
     */
}
