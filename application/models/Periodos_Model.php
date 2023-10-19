<?php  
class Periodos_Model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    function create($data){
        $this->db->insert("periodos", $data);
        return $this->db->insert_id();
    }

    function update($data){
        $this->db->where("id_periodo", $data["id_periodo"]);
        return $this->db->update("periodos", $data);
    }

    function delete($idPeriodo){
        $this->db->where("id_periodo", $idPeriodo);
        return $this->db->delete("periodos");
    }

    function find($idPeriodo){
        $this->db->where("id_periodo", $idPeriodo);
        $this->db->from("periodos");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	} 

    function getAll(){
        $this->db->from("periodos");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}   
}