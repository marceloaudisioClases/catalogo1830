<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Productos_model');
	}
	public function index()
	{
		$datos["productos"] = $this->Productos_model->listado_productos();
		$this->load->view('catalogo/productos',$datos);
	}
}
