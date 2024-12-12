<?php
class Api_model extends CI_Model {

    public function obtener_por_apikey($apikey=""){
        $this->db->select("*");
        $this->db->where("apikey",$apikey);
        $this->db->limit(1);
        return $this->db->get("usuarios")->row_array();       
    }

}