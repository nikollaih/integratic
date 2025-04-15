<?php
class Usuarios_Model extends CI_Model {
 
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  	public function login($usr,$pass){
    	$result=$this->db->query("Select * From usuarios where usuario='$usr' And clave='$pass' ");
    	if(!$result) {return false;}
    	else {return $result->result();}      
  	}  
	
	function add($data){
		return $this->db->insert("usuarios", $data);
	}

	// Update the user information
  	public function update_user($data){
    	$this->db->where("id", $data["id"]);
		return $this->db->update("usuarios", $data);
  	}

	  public function update_old_user($id, $data){
    	$this->db->where("id", $id);
		return $this->db->update("usuarios", $data);
  	}

	public function get_user($id){
		$this->db->from("usuarios");
		$this->db->where("id", $id);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	public function get_all(){
        $this->db->where("estado", "ac");
		$this->db->from("usuarios");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    public function get_by_role($role){
        $this->db->where("rol", $role);
        $this->db->where("estado", "ac");
        $this->db->from("usuarios");
        $this->db->order_by("nombres", "asc");
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

	public function delete_all_users_rol($rol){
		$this->db->where("rol", $rol);
		return $this->db->delete("usuarios");
	}

	function delete($id){
		$this->db->where("id", $id);
		return $this->db->delete("usuarios");
	}
}
