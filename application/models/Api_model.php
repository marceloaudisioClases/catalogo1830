<?php
class Api_model extends CI_Model {

    public function obtener_por_apikey($apikey=""){
        $this->db->select("*");
        $this->db->where("apikey",$apikey);
        $this->db->limit(1);
        return $this->db->get("usuarios")->row_array();       
    }
    public function nuevo_evento($usuario_id,$metodo){
        $this->db->set("usuario_id",$usuario_id);
        $this->db->set("metodo",$metodo);
        return $this->db->insert("api_log");
    }

}