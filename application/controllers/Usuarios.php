<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	public function index()
	{
		$datos=array();
		$this->load->model("categorias_model");
		$datos["categorias"] = $this->categorias_model->listar();
		$this->load->view('catalogo/principal',$datos);
	}
}
