<?php
class Categorias_model extends CI_Model {

    public function listar(){
        $this->db->select("*");
        
        $this->db->where("estado",1);
        $this->db->order_by("orden");
        $this->db->order_by("nombre");
        return $this->db->get("categorias")->result_array();
    }

    public function obtener_por_id($id){
        $this->db->select("*");
        $this->db->where("categoria_id",$id);
        $this->db->limit(1);
        return $this->db->get("categorias")->row_array();       
    }
}