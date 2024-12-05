<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	public function index()
	{
		$datos=array();
		$this->load->model("usuarios_model");
		$datos["usuarios"] = $this->usuarios_model->listar();
		$this->load->view('usuarios',$datos);
	}

	public function send_test() {
        $this->load->library('email');
        $this->email->initialize();

        $this->email->from('correo Ejemplo', 'Sistema');
        $this->email->to('correo ejemplo');
        $this->email->subject('Test');
        $this->email->message('Es una Prueba');

        if ($this->email->send()) {
            echo 'Email Enviado';
        } else {
            echo 'Falló al enviar email';
            echo $this->email->print_debugger();
        }
    }
}
