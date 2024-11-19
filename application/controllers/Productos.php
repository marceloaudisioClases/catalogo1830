<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata("usuario_id")){
			$this->session->set_flashdata("OP","PROHIBIDO");
			redirect("auth/login");
		}
		$this->load->model("productos_model");
	}
	public function index()
	{
		redirect("productos/alta");
	}

	public function alta(){
		$datos=array();

		$this->load->model("categorias_model");
		$this->load->library('form_validation');

        $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');
        $this->form_validation->set_rules('categoria_id', 'Categoría', 'required|integer');
        $this->form_validation->set_rules('stock_actual', 'Stock Actual', 'required|integer');
        $this->form_validation->set_rules('stock_min', 'Stock Mínimo', 'required|integer');
        $this->form_validation->set_rules('costo', 'Costo', 'required|integer');

      if ($this->form_validation->run() == FALSE) {
		$datos["categorias"]=$this->categorias_model->listar();
		$this->load->view('productos/formulario',$datos);
	  } else {
		$data=array();
		$data['nombre']= set_value('nombre');
		$data['descripcion']= set_value('descripcion');
		$data['categoria_id']= set_value('categoria_id');
		$data['stock_actual']= set_value('stock_actual');
		$data['stock_min']= set_value('stock_min');
		$data['costo']= set_value('costo');

		$this->productos_model->nuevo($data);

	    echo "Producto guardado exitosamente.";
	  }
  }
}