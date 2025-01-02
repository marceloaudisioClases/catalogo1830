<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {


    public function index()
    {
        $datos = array();
        $this->load->model("usuarios_model");
        $datos["usuarios"] = $this->usuarios_model->listar();
        $this->load->view('usuarios', $datos);
    }

    public function editar($id) {
        $this->load->model('usuarios_model');
        
        $datos['usuario'] = $this->usuarios_model->obtener_por_id($id);
        
        $this->load->view('editarusuarios', $datos);
    }


    
    public function actualizar() {
        $id = $this->input->post('usuario_id');
        $email = $this->input->post('email');
        $conf_email = $this->input->post('conf_email');
        $apellido = $this->input->post('apellido');
        $conf_apellido = $this->input->post('conf_apellido');
        $nombre = $this->input->post('nombre');
        $conf_nombre = $this->input->post('conf_nombre');
        $usuario = $this->input->post('usuario');
        $conf_usuario = $this->input->post('conf_usuario');
    
        $this->session->unset_userdata(['MSJ', 'error']);
        
        if ($email != $conf_email) {
            $this->session->set_flashdata('error', 'Los campos de correo electrónico no coinciden. Intenta nuevamente.');
            redirect('usuarios/editar/' . $id);
            return;
        }
        
        if ($apellido != $conf_apellido) {
            $this->session->set_flashdata('error', 'Los campos de apellido no coinciden. Intenta nuevamente.');
            redirect('usuarios/editar/' . $id);
            return;
        }
        
        if ($nombre != $conf_nombre) {
            $this->session->set_flashdata('error', 'Los campos de nombre no coinciden. Intenta nuevamente.');
            redirect('usuarios/editar/' . $id);
            return;
        }
        
        if ($usuario != $conf_usuario) {
            $this->session->set_flashdata('error', 'Los campos de usuario no coinciden. Intenta nuevamente.');
            redirect('usuarios/editar/' . $id);
            return;
        }
        
    
        $update_data = [
            'email' => $email,
            'apellido' => $apellido,
            'nombre' => $nombre,
            'usuario' => $usuario,
        ];
    
        $this->load->model('Usuarios_model');
        $resultado = $this->Usuarios_model->actualizar($id, $update_data);
    
        if ($resultado) {
            $this->session->set_flashdata('MSJ', 'Usuario actualizado correctamente');
        } else {
            $this->session->set_flashdata('error', 'No se pudo actualizar el usuario. Intenta nuevamente.');
        }
    
        redirect('usuarios/editar/' . $id);
    }   
    
    public function buscar()
    {
        $rol = $this->input->get('rol');
        $nombre = $this->input->get('nombre');
        $apellido = $this->input->get('apellido');
    
        $this->load->model('Usuarios_model');
        $datos = array();
    
        if (isset($rol) and $rol !== '') { 
            $rol = intval($rol);
            $datos['usuarios'] = $this->Usuarios_model->buscarPorRol($rol);
        } else {
            if (isset($nombre) and $nombre !== '') {
                $datos['usuarios'] = $this->Usuarios_model->buscarPorNombre($nombre);
            } else {
                if (isset($apellido) and $apellido !== '') {
                    $datos['usuarios'] = $this->Usuarios_model->buscarPorApellido($apellido);
                } else {
                    $this->session->set_flashdata('error', 'Usa la barra de busqueda');
                    redirect('usuarios');
                    return;
                }
            }
        }
        
    
        $this->load->view('usuarios', $datos);
    }
    
    public function fotoperfil() {
        $this->load->model('Usuarios_model');
    
        $usuario_id = $this->session->userdata('usuario_id'); 
    
        if ($this->input->post('profile_pic')) {
            $selected_image = $this->input->post('profile_pic');
    
            $this->Usuarios_model->actualizar($usuario_id, ['imagen_perfil' => $selected_image]);
    
            $this->session->set_flashdata('success', 'Imagen de perfil actualizada correctamente.');
            redirect('usuarios/fotoperfil'); 
        }
    
        $datos['usuario'] = $this->Usuarios_model->obtener_por_id($usuario_id);
    
        $this->load->view('fotoperfil', $datos);
    }
    
    public function ir_papelera() {
        $this->load->model("Usuarios_model");
        $datos['eliminados'] = $this->Usuarios_model->listar_eliminados();
        $this->load->view('papelera', $datos);
    }
    public function exportar_csv_usuarios() {
        $this->load->helper("download");
        $this->load->model('Usuarios_model'); 
    
        $datos = $this->Usuarios_model->listar();
        $archivo = "datos-exportados-" . date("d-m-Y") . ".csv";
        $titulos = ["Id", "Email", "Apellido", "Nombre", "Usuario", "Estado", "Rol"];
        $roles = [1 => "Administrador", 2 => "Usuario", 3 => "Cliente"];
        $contenido = implode(";", $titulos) . "\n";
        
        foreach ($datos as $linea) {
            unset($linea["creado"], $linea["ult_login"], $linea["motivo_eliminacion"], $linea["fecha_eliminacion"], $linea["imagen_perfil"]);
            if (isset($roles[$linea["rol_id"]])) {
                $linea["rol_id"] = $roles[$linea["rol_id"]];
            } else {
                $linea["rol_id"] = "Desconocido";
            }
            $contenido .= implode(";", [
                $linea["usuario_id"],
                $linea["email"],
                $linea["apellido"],
                $linea["nombre"],
                $linea["usuario"],
                $linea["estado"],
                $linea["rol_id"]
            ]) . "\n";
        }
        force_download($archivo, $contenido, "application/csv");
    }
    

    public function eliminar() {
        $this->load->model('Usuarios_model');
    
        $usuario_id = $this->input->post('usuario_id');
        $motivo = $this->input->post('motivo');
    
        if ((!isset($usuario_id) or $usuario_id === '') or (!isset($motivo) or $motivo === '')) {
            $this->session->set_flashdata('error', 'El motivo es obligatorio.');
            redirect('usuarios');
            return;
        }
        
    
     $datos = array(
        'estado' => -1,
        'motivo_eliminacion' => $motivo,
        'fecha_eliminacion' => date('Y-m-d H:i:s')
    );
    
    
        $resultado = $this->Usuarios_model->actualizar($usuario_id, $datos);
    
        if ($resultado) {
            $this->session->set_flashdata('MSJ', 'Usuario eliminado correctamente.');
        } else {
            $this->session->set_flashdata('error', 'No se pudo eliminar el usuario.');
        }
    
        redirect('usuarios'); 
    }

    public function restaurar() {
        $usuario_id = $this->input->post('usuario_id');
    
        if (!$usuario_id) {
            $this->session->set_flashdata('error', 'ID de usuario no válido.');
            redirect('usuarios/ir_papelera');
            return;
        }
    
        $this->load->model('Usuarios_model');
        $resultado = $this->Usuarios_model->restaurar_usuario($usuario_id);
    
        if ($resultado) {
            $this->Usuarios_model->vaciar_motivo_eliminacion($usuario_id);
            
            $this->session->set_flashdata('MSJ', 'Usuario restaurado correctamente.');
        } else {
            $this->session->set_flashdata('error', 'No se pudo restaurar el usuario.');
        }
    
        redirect('usuarios/ir_papelera');
    }
}



