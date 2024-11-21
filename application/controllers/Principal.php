<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata("usuario_id")){
			$this->session->set_flashdata("OP","PROHIBIDO");
			redirect("auth/login");
		}
	}
	public function index()
	{
		$datos= array();
		$this->load->model("productos_model");
		$datos["total_productos"]=$this->productos_model->contar();
		$this->load->view('principal',$datos);
	}
	public function micuenta()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules("password","Contraseña","required");
		$this->form_validation->set_rules("conf-password","Confirmar Contraseña","matches[password]");

		if ($this->form_validation->run() == FALSE){
            $this->load->view('micuenta');
        }else{
			$this->load->model("usuarios_model");
			$usuario_id= $this->session->userdata("usuario_id");
			$password=set_value("password");
			$this->usuarios_model->actualizar_password($usuario_id,$password);
			$this->session->set_flashdata("OP","CAMBIAPASS");
			redirect("principal/micuenta");
		}
	}
}
