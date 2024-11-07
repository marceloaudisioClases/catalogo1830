<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata("usuario_id")){
			$this->session->set_flashdata("OP","PROHIBIDO");
			redirect("auth/login");
		}
	}
	public function index()
	{
		$datos=array();
		$this->load->model("categorias_model");
		$datos["categorias"] = $this->categorias_model->listar();
		$this->load->view('catalogo/principal',$datos);
	}
}
