<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Roles_model');
        $this->load->model('Roles2_model');
    }

    public function index() {
        $data['roles'] = $this->Roles_model->listar();
        $data['usuarios'] = $this->Roles2_model->listar();

        // Cargar la vista con los datos obtenidos
        $this->load->view('roless/roles', $data);
    }

    public function listar() {
        $data['roles'] = $this->Roles_model->listar();
        $this->load->view('auth/login', $data);
    }
    public function cambiar_rol($usuario_id, $rol_id) {
        $nombre_usuario = $this->Roles2_model->obtener_nombre_usuario($usuario_id);
        if ($this->Roles2_model->cambiar_rol($usuario_id, $rol_id)) {
            $this->session->set_flashdata("success", "El rol de $nombre_usuario ha sido actualizado exitosamente.");
        } else {
            $this->session->set_flashdata("error", "Error al actualizar el rol");
        }
        redirect('roles');
    }
}

