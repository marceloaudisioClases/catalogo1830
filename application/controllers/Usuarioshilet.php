<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarioshilet extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata("usuario_id")) {
            $this->session->set_flashdata("OP", "PROHIBIDO");
            redirect("auth/login");
        }

        $this->load->model("Usuarioshilet_model");
        $this->load->model("roles2_model");
    }

    public function index() {
        $datos = array();
        $datos["usuarios"] = $this->Usuarioshilet_model->listar();
        $this->load->view('usuarioshilet', $datos);
    }

    public function listar() {
        $datos = array();
        $campos_permitidos = array("usuario_id", "usuario", "nombre", "apellido", "rol_id", "email", "ult_login", "estado");
        $partes = $this->uri->uri_to_assoc();

        if (isset($partes["orden"])) {
            if (in_array($partes["orden"], $campos_permitidos)) {
                $this->Usuarioshilet_model->set_campo_orden($partes["orden"]);
                $sentido = $this->uri->segment(5); 
                if ($sentido === "DESC") {
                    $campoSentido = "DESC";
                } else {
                    $campoSentido = "ASC";
                }
                $this->Usuarioshilet_model->set_campo_sentido($campoSentido);
                
            }
        }

        $datos["usuarios"] = $this->Usuarioshilet_model->listar();
        $this->load->view('usuarioshilet', $datos);
    }

    public function exportar_csv_usuarioshilet() {
        $this->load->helper("download");
        $datos = $this->Usuarioshilet_model->listar();
        $archivo = "usuarioshilet-exportados-" . date("d-m-Y") . ".csv";
        $titulos = array("Codigo", "Email", "Apellido", "Nombre", "Usuario", "Password", "Estado", "Rol", "APIKEY");

        $contenido = implode(";", $titulos) . "\n";

        foreach ($datos as $linea) {
            unset($linea["creado"]);
            unset($linea["ult_login"]);
            $linea["rol_id"] = $linea["rol_nombre"];
            unset($linea["rol_nombre"]);
            $contenido .= implode(";", $linea) . "\n";
        }

        force_download($archivo, $contenido, "application/csv");
    }

    public function send_test() {
        $this->load->library('email');
        $this->email->initialize();

        $this->email->from('correo@ejemplo.com', 'Sistema');
        $this->email->to('destinatario@ejemplo.com');
        $this->email->subject('Prueba de correo');
        $this->email->message('Este es un correo de prueba.');

        if ($this->email->send()) {
            echo 'Correo enviado correctamente';
        } else {
            echo 'Error al enviar el correo';
            echo $this->email->print_debugger();
        }
    }
}
