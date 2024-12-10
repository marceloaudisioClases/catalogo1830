<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	var $json=array("status"=>"ERROR","message"=> "");

	public function listadeprecios(){
		$this->load->model("productos_model");
		$this->output->set_content_type("application/json");
		$this->output->set_status_header(200);
		$this->json["status"]="OK";
		$this->json["data"]=$this->productos_model->listar();
		
		foreach($this->json["data"] as $key=>$val){
			unset($val["stock_min"]);
			$this->json["data"][$key]=$val;
		}
		
		$this->json["rowCount"]=sizeof($this->json["data"]);
		$this->output->set_output(json_encode($this->json));
	}

	public function producto_actualizar_precio(){
		if($this->validar_apikey()){
			$this->output->set_content_type("application/json");
			
			$datos=$this->input->post();
			if(isset($datos["id"]) and isset($datos["costo"])){
				$this->load->model("productos_model");
				
				$nuevo_precio=array(
					"costo"=>$datos["costo"]
				);

				$this->productos_model->actualizar($datos["id"],$nuevo_precio);
				$this->output->set_status_header(200);
				$this->json["status"]="OK";
			}else{
				$this->output->set_status_header(400);
				$this->json["message"]="Datos incorrectos";
			}
		}
		$this->output->set_output(json_encode($this->json));
	}

	private function validar_apikey(){
		$apikey=$this->input->get_request_header("X-API-KEY");
		if(isset($apikey)){
			if($apikey=="123456"){
				return true;
			}else{
				$this->output->set_status_header(403);
				$this->json["message"]="API-KEY Incorrecta";
				$this->json["status"]="ERROR";
				return false;
			}
			
		}else{
			$this->output->set_status_header(403);
			$this->json["message"]="Se necesita API-KEY";
			$this->json["status"]="ERROR";
			return false;
		}
	}
}
