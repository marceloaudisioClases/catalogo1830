<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productos_model extends CI_Model {
    public function nuevo($data) {
        $this->db->insert('productos', $data);
        return $this->db->insert_id();
    }
    public function actualizar($id,$data) {
        $this->db->where('producto_id', $id);
        $this->db->update('productos', $data);
        return $this->db->affected_rows();
    }
    public function listar() {
        $query = $this->db->get('productos');
        return $query->result_array();
    }
    public function obtener_por_id($id) {
        $query = $this->db->get_where('productos', array('producto_id' => $id));
        return $query->row_array();
    }

    public function contar(){
        return $this->db->count_all("productos");
    }
}