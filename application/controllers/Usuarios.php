<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata("usuario_id")){
			$this->session->set_flashdata("OP","PROHIBIDO");
			redirect("auth/login");
		}
		$this->load->model("usuarios_model");
	}
	public function index()
	{
		$datos=array();
		$this->load->model("usuarios_model");
		$datos["usuarios"] = $this->usuarios_model->listar();
		$this->load->view('usuarios',$datos);
	}
	public function listar(){
		$datos=array();
		$campos_permitidos=array("usuario_id","usuario","nombre","apellido","rol_id","email","ult_login");
		$partes=$this->uri->uri_to_assoc();
		if(isset($partes["orden"])){
			if(in_array($partes["orden"],$campos_permitidos)){
				$this->usuarios_model->set_campo_orden($partes["orden"]);
			}
		}
				
		$datos["usuarios"]=$this->usuarios_model->listar();

		$this->load->view('usuarios',$datos);
	}
}
