<?php
class Roles_Model extends CI_Model {
    function listar() {
     
          
      $this->db->select('roles.*');
      $this->db->from("roles");
   $this->db->order_by("rol_id","ASC");
     
        $recordset = $this->db->get();
        return $recordset->result_array();
    }
    public function actualizar_estado($rol_id, $estado) //Cambia estados
    {
        $data = array('estado' => $estado);
        $this->db->where('rol_id', $rol_id);
        $this->db->update('roles', $data);
    }
}



    