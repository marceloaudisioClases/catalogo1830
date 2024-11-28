<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata("usuario_id")){
			$this->session->set_flashdata("OP","PROHIBIDO");
			redirect("auth/login");
		}
		$this->load->model("categorias_model");
		$this->load->model("productos_model");
	}
	public function index()
	{
		redirect("catalogo/categoria");
	}
	public function categoria($categoria_id=false,$buscar="")
	{
		$datos=array();
		if($categoria_id==false){
			$datos["categoria_id"]=0;
		}else{
			if($categoria_id=="buscar"){
				$datos["buscar"]= $buscar;
			}else{
				$datos["categoria_id"]=intval($categoria_id);
				$datos["categoria_seleccionada"]=$this->categorias_model->obtener_por_id($datos["categoria_id"]);
				if(!$datos["categoria_seleccionada"]){
					$datos["categoria_id"]=0;	
				}
			}
		}
		if(isset($datos["buscar"])){
			$this->productos_model->set_buscar($datos["buscar"]);
			$datos["productos"]=$this->productos_model->listar();
		}else{
			if($datos["categoria_id"]>0){
				$this->productos_model->set_categoria($datos["categoria_id"]);
				$datos["productos"]=$this->productos_model->listar();
			}else{
				$datos["productos"]=array();
			}
		}
		
		$datos["categorias"] = $this->categorias_model->listar();
		$this->load->view('catalogo/principal',$datos);
	}
	public function buscar(){
		$buscar=trim($this->input->post("buscar"));
		
		if(strlen($buscar)> 0){
			redirect("catalogo/categoria/buscar/".$buscar);
		}else{
			redirect("catalogo");
		}
	}
	public function ver($producto_id){
	$ver=$this->productos_model->obtener_por_id( $producto_id );
	$this->load->view("catalogo/ver",$ver);
	}
}
