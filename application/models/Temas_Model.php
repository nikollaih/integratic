<?php
class Temas_Model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

	function create($data){
		$this->db->insert("temas", $data);
        return $this->db->insert_id();
	}

  	public function update($data){
    	$this->db->where("id_tema", $data["id_tema"]);
		return $this->db->update("temas", $data);
  	}

	public function find($id){
		$this->db->from("temas");
		$this->db->where("id_tema", $id);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	public function get_by_materias($ids = []){
		$this->db->from("temas t");
		$this->db->where("t.status = 1");
		if(count($ids) > 0){
			$like_sql = "(";
			for ($i=0; $i < count($ids); $i++) { 
				$like_sql .= ($i == 0) ? "`t`.`materias` LIKE '%".$ids[$i]."%'" : " OR `t`.`materias` LIKE '%".$ids[$i]."%'";
			}
			$like_sql .= ")";
			$this->db->where($like_sql);
		}
		else return false;
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    public function getByIds($ids = []) {
        $this->db->from("temas t");
        $this->db->where_in("t.id_tema", $ids);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}
