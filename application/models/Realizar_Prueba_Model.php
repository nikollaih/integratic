<?php
class Realizar_Prueba_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get($id_prueba, $id_participante){
		$this->db->from("realizar_prueba rp");
		$this->db->where("rp.id_prueba", $id_prueba);
		$this->db->where("rp.id_participante", $id_participante);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_by_id($id_realizar_prueba){
		$this->db->from("realizar_prueba rp");
		$this->db->where("rp.id_realizar_prueba", $id_realizar_prueba);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_by_participante($id_participante){
		$this->db->from("realizar_prueba rp");
		$this->db->join("pruebas p", "p.id_prueba = rp.id_prueba");
		$this->db->where("rp.id_participante", $id_participante);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function create($data){
        $this->db->insert("realizar_prueba", $data);
        return $this->get_by_id($this->db->insert_id());
    }

	function update($data){
		$this->db->where("id_realizar_prueba", $data["id_realizar_prueba"]);
		return $this->db->update("realizar_prueba", $data);
	}

	function delete($id_realizar_prueba){
		$this->db->where("id_realizar_prueba", $id_realizar_prueba);
		return $this->db->delete("realizar_prueba");
	}

	function get_aprobadas($ids_materias, $tipo = true, $value = 60){
		$query = "";
		if(is_array($ids_materias)){
			for ($i=0; $i < count($ids_materias) ; $i++) { 
				$query.= "p.materias LIKE '%".$ids_materias[$i]."%' OR ";
			}
		}
		$query = substr($query, 0, -4);

		$this->db->from("realizar_prueba rp");
		$this->db->join("pruebas p", "p.id_prueba = rp.id_prueba");
		if($tipo){
			$this->db->where("rp.calificacion >= ", $value);
		}
		else{
			$this->db->where("rp.calificacion <= ", $value);
		}
		$this->db->where($query, NULL, FALSE);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}
}