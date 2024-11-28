<?php
class Productos_model extends CI_Model {
    
    var $categoria_id=false;
    var $buscar=false;

    public function set_categoria($categoria_id=false){
        $this->categoria_id=$categoria_id;
    }
    public function set_buscar($buscar=false){
        $this->buscar=$buscar;
    }
    public function nuevo($data) {
       $this->db->insert('productos', $data);
       return $this->db->insert_id();
    }

    public function actualizar($id,$data){
        $this->db->where('producto_id', $id);
        $this->db->update('productos', $data);
        return $this->db->affected_rows();
    }

    public function listar() {
        if ($this->categoria_id!=false) {
            $this->db->where('categoria_id', $this->categoria_id);
        }
        if ($this->buscar!=false) {
            $this->db->like('nombre', $this->buscar);
        }
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
?>
