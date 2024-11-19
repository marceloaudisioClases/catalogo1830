<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata("usuario_id")){
			$this->session->set_flashdata("OP","PROHIBIDO");
			redirect("auth/login");
		}
	}
	public function index()
	{
		redirect("productos/alta");
	}

	public function alta(){
		$this->load->library('form_validation');

        $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');
        $this->form_validation->set_rules('categoria_id', 'Categoría', 'required|integer');
        $this->form_validation->set_rules('stock_actual', 'Stock Actual', 'required|integer');
        $this->form_validation->set_rules('stock_min', 'Stock Mínimo', 'required|integer');
        $this->form_validation->set_rules('costo', 'Costo', 'required|decimal');

      if ($this->form_validation->run() == FALSE) {
		$this->load->view('productos/formulario');
	  } else {
	    echo "Producto guardado exitosamente.";
	  }
  }
}