<?php
class Productos_model extends CI_Model {

    public function contar(){
        $this->db->select("*");
    }

    public function obtener_por_id($id){
        $this->db->select("*");
        $this->db->where("producto_id",$id);
        $this->db->limit(1);
        return $this->db->get("productos")->row_array();       
    }
    public function pepon(array $data){
    }
}