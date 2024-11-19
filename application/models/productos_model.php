<?php
class Productos_model extends CI_Model {

    public function nuevo($data) {
        return $this->db->insert('productos', $data);
    }

    public function listar() {
        $query = $this->db->get('productos');
        return $query->result_array();
    }

    public function obtener_por_id($id) {
        $query = $this->db->get_where('productos', array('id' => $id));
        return $query->row_array();
    }
}
?>
