<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata("usuario_id")){
			$this->session->set_flashdata("OP","PROHIBIDO");
			redirect("auth/login");
		}
		$this->load->model("usuarios_model");
		$this->load->model("roles2_model");
	}
	public function index()
	{
		$datos=array();
		$this->load->model("usuarios_model");
		$datos["usuarios"] = $this->usuarios_model->listar();
		$this->load->view('usuarios',$datos);
	}

	public function send_test() {
        $this->load->library('email');
        $this->email->initialize();

        $this->email->from('correo Ejemplo', 'Sistema');
        $this->email->to('correo ejemplo');
        $this->email->subject('Test');
        $this->email->message('Es una Prueba');

        if ($this->email->send()) {
            echo 'Email Enviado';
        } else {
            echo 'Falló al enviar email';
            echo $this->email->print_debugger();
        }
    }
	public function listar(){
		$datos=array();
		$campos_permitidos=array("usuario_id","usuario","nombre","apellido","rol_id","email","ult_login");
		$partes=$this->uri->uri_to_assoc();
		if(isset($partes["orden"])){
			if(in_array($partes["orden"],$campos_permitidos)){
				$this->usuarios_model->set_campo_orden($partes["orden"]);
			}
		}
				
		$datos["usuarios"]=$this->usuarios_model->listar();

		$this->load->view('usuarios',$datos);
	}
	public function exportar_csv_usuarios(){
		$this->load->helper("download");
		$datos=$this->usuarios_model->listar();
		$datos=$this->roles2_model->listar();
		$archivo="datos-exportados-".date("d-m-Y").".csv";
		$titulos=array("Codigo","Email","Apellido","Nombre","Usuario","Password","Estado","Rol","APIKEY");
		
		//Agrego los Titulos
		$contenido=implode(";",$titulos)."\n";
		
		//Agrego los datos
		foreach($datos as $linea){
			unset($linea["creado"]);
			unset($linea["ult_login"]);
			$linea["rol_id"]=$linea["rol_nombre"];
			unset($linea["rol_nombre"]);
			$contenido.= implode(";",$linea)."\n";
		}

		force_download($archivo,$contenido,"application/csv");
	}
}
