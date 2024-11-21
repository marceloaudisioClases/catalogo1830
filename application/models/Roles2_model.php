<?php
class Roles2_model extends CI_Model {
    
    public function listar() {
        $this->db->select('usuarios.*, roles.nombre AS rol_nombre');
        $this->db->from('usuarios');
        $this->db->join('roles', 'roles.rol_id = usuarios.rol_id', 'left');
        $this->db->order_by("usuario_id", "DESC");
        return $this->db->get()->result_array();
    }

    // Crear un nuevo usuario
    public function nuevo($email, $usuario, $password, $nombre, $apellido) {
        $this->db->set("email", $email);
        $this->db->set("password", $password);
        $this->db->set("nombre", $nombre);
        $this->db->set("apellido", $apellido);
        $this->db->set("usuario", $usuario);
        $this->db->insert("usuarios");
        return $this->db->insert_id();
    }

    public function obtener_por_id($id) {
        $this->db->select("*");
        $this->db->where("usuario_id", $id);
        $this->db->limit(1);
        return $this->db->get("usuarios")->row_array();
    }

    public function check_login($usuario, $password) {
        $this->db->select("usuario_id");
        $this->db->where("usuario", $usuario);
        $this->db->where("password", $password);
        $this->db->limit(1);
    
        $result = $this->db->get("usuarios")->row_array();
        if (isset($result["usuario_id"])) {
            return $result["usuario_id"];
        }
    
        return false;
    }
    
    public function actualizar_login($usuario_id) {
        $this->db->set("ult_login", "NOW()", FALSE);
        $this->db->where("usuario_id", $usuario_id);
        $this->db->update("usuarios");
    }

    public function cambiar_rol($usuario_id, $rol_id) {
        $data = array('rol_id' => $rol_id);
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->update('usuarios', $data);
    }

    public function obtener_nombre_usuario($usuario_id) {
        $this->db->select('nombre');
        $this->db->from('usuarios');
        $this->db->where('usuario_id', $usuario_id);
        $query = $this->db->get();
        $result = $query->row();
    
        if ($result) {
            return $result->nombre;
        } else {
            return false;
        }
    }    
}
?>
