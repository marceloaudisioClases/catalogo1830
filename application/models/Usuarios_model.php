<?php
class Usuarios_model extends CI_Model {
    public function nuevo($email,$usuario,$password,$nombre,$apellido){
        $this->db->set("email",$email);
        $this->db->set("password",$password);
        $this->db->set("nombre",$nombre);
        $this->db->set("apellido",$apellido);
        $this->db->set("usuario",$usuario);
        
        $this->db->insert("usuarios");

        return $this->db->insert_id();
    }

    public function obtener_por_id($id){
        $this->db->select("*");
        $this->db->where("usuario_id",$id);
        $this->db->limit(1);
        return $this->db->get("usuarios")->row_array();       
    }

    public function check_login($usuario,$password){
        $this->db->select("usuario_id");
        $this->db->where("usuario",$usuario);
        $this->db->where("password",$password);
        $this->db->limit(1);
        $tmp=$this->db->get("usuarios")->row_array();
        if($tmp){
            return $tmp["usuario_id"];
        }else{
            return false;
        }       
    }

    public function actualizar_login($usuario_id){
        $this->db->set("ult_login","NOW()",FALSE);
        $this->db->where("usuario_id",$usuario_id);
        $this->db->update("usuarios");
    }
    public function actualizar_password($usuario_id,$pass){
        $this->db->set("password",$pass);
        $this->db->where("usuario_id",$usuario_id);
        $this->db->update("usuarios");
    }

    






    
    //PARTE USUARIOS 
    public function listar(){
        $this->db->select("*");
        $this->db->order_by("usuario_id");
        $this->db->order_by("nombre");
        return $this->db->get("usuarios")->result_array();
    }
    public function buscarPorRol($rol) 
{
    $this->db->like('rol_id', $rol);
    $busqueda = $this->db->get('usuarios');
    return $busqueda->result_array();
}

public function buscarPorNombre($nombre)
{
    $this->db->like('nombre', $nombre);
    $busqueda = $this->db->get('usuarios');
    return $busqueda->result_array();
}
public function buscarPorApellido($apellido)
{
    $this->db->like('apellido', $apellido);
    $busqueda = $this->db->get('usuarios');
    return $busqueda->result_array();
}
public function obtener_usuario_por_id($usuario_id)
{
    $query = $this->db->from('usuarios')->where('usuario_id', $usuario_id)->limit(1);

    return $query->row_array(); 
}

public function actualizar($id, $datos) {
    $this->db->where('usuario_id', $id);
    return $this->db->update('usuarios', $datos);
}


public function editar($id) {
   $usuario = $this->usuarios_model->obtener_usuario_por_id($id);
   if (!$usuario) {
        $this->session->set_flashdata('error', 'Usuario no encontrado');
        redirect('usuarios');
    }
    $data = array('usuario', $usuario);
    $this->load->view('usuarios/editar', $data);
}


public function listar_eliminados() {
    $this->db->select("*");
    $this->db->where("estado", -1);
    $this->db->order_by("fecha_eliminacion", "DESC");
    return $this->db->get("usuarios")->result_array();
}


public function restaurar_usuario($usuario_id) {
    $this->db->set('estado', 1);
    $this->db->where('usuario_id', $usuario_id);
    return $this->db->update('usuarios');
}

public function vaciar_motivo_eliminacion($usuario_id) {
    $this->db->set('motivo_eliminacion', ''); 
    $this->db->where('usuario_id', $usuario_id);
    return $this->db->update('usuarios');
  }
}