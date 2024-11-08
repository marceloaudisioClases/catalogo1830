<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Categorias_model');
	}
	public function index()
	{
		$datos["categorias"] = $this->Categorias_model->listado_categoria();
		$this->load->view('catalogo/categorias',$datos);
	}
}
