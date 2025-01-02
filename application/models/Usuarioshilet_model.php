<?php
class Usuarioshilet_model extends CI_Model {

    var $rol_id=false;
    var $campo_orden="usuarios.usuario_id";
    var $campo_sentido="ASC";
    public function set_campo_orden($campo="usuarios.usuario_id"){
        $this->campo_orden=$campo;
    }
    public function set_campo_sentido($sentido= "ASC"){
        $this->campo_sentido=$sentido;
    }

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
    public function listar(){

        $this->db->select("usuarios.*,roles.nombre AS rol_nombre");
        if($this->rol_id!=false){
            $this->db->where('usuarios.rol_id', $this->rol_id);
        }
        $this->db->join("roles","usuarios.rol_id=roles.rol_id","inner");

        $this->db->order_by($this->campo_orden, $this->campo_sentido);
        
        return $this->db->get("usuarios")->result_array();
    }
    
}