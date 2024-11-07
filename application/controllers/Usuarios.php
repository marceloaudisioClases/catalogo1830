<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	public function index()
	{
		$datos=array();
		$this->load->model("usuarios_model");
		$datos["usuarios"] = $this->usuarios_model->obtener_por_id();
		$this->load->view('catalogo/principal',$datos);
	}
}
