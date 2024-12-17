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
		redirect("productos/listar");
	}
	public function alta() {
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

			$id=$this->productos_model->nuevo($data);
			$this->session->set_flashdata("OP","Insertado el producto: ".$id);
			redirect("productos/editar/".$id);
		}
	}
	public function editar($id=false) {
		$datos=array();

		if($id!=false){
			$producto_id=intval($id);
			$datos["producto"]=$this->productos_model->obtener_por_id($producto_id);
		}else{
			$datos["producto"]=false;
		}



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
			$this->load->view('productos/formularioeditar',$datos);
		} else {
			$data=array();
			$data['nombre']= set_value('nombre');
			$data['descripcion']= set_value('descripcion');
			$data['categoria_id']= set_value('categoria_id');
			$data['stock_actual']= set_value('stock_actual');
			$data['stock_min']= set_value('stock_min');
			$data['costo']= set_value('costo');

			$id=$this->productos_model->actualizar($producto_id,$data);
			$this->session->set_flashdata('MSJ','Actualizado');
			redirect("productos/editar/".$producto_id);
		}
	}

	public function listar(){
		$datos=array();
		$campos_permitidos=array("producto_id","costo","nombre");
		$partes=$this->uri->uri_to_assoc();
		if(isset($partes["orden"])){
			if(in_array($partes["orden"],$campos_permitidos)){
				$this->productos_model->set_campo_orden($partes["orden"]);
			}
		}
				
		$datos["productos"]=$this->productos_model->listar();

		$this->load->view('productos/listado',$datos);
	}

	public function exportar_csv(){
		$this->load->helper("download");
		$datos=$this->productos_model->listar();
		$archivo="datos-exportados-".date("d-m-Y").".csv";
		$titulos=array("Codigo","Nombre","Categoria","Stock Actual","Stock Min","Precio","Estado",);
		
		//Agrego los Titulos
		$contenido=implode(";",$titulos)."\n";
		
		//Agrego los datos
		foreach($datos as $linea){
			unset($linea["descripcion"]);
			$linea["categoria_id"]=$linea["categoria_nombre"];
			unset($linea["categoria_nombre"]);
			$contenido.= implode(";",$linea)."\n";
		}

		force_download($archivo,$contenido,"application/csv");
	}
}
