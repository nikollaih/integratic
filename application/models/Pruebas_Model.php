<?php
class Pruebas_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function get_all(){
        $this->db->select("p.*, tp.descripcion as tipo_prueba, ap.descripcion as alcance_prueba");
		$this->db->from("pruebas p");
		$this->db->join("alcance_prueba ap", "p.alcance_prueba = ap.id_alcance_prueba");
        $this->db->join("tipo_prueba tp", "p.tipo_prueba = tp.id_tipo_prueba");
		$this->db->where("p.estado !=", 2);
		$this->db->order_by("p.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_docente_all($id){
		$this->db->select("p.*, tp.descripcion as tipo_prueba, ap.descripcion as alcance_prueba");
		$this->db->from("pruebas p");
		$this->db->join("alcance_prueba ap", "p.alcance_prueba = ap.id_alcance_prueba");
		$this->db->join("tipo_prueba tp", "p.tipo_prueba = tp.id_tipo_prueba");
		$this->db->where("created_by", $id);
		$this->db->where("p.estado !=", 2);
		$this->db->order_by("p.created_at", "desc");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
		/*$query = "(";
		if(is_array($ids)){
			for ($i=0; $i < count($ids) ; $i++) { 
				$query.= "p.materias LIKE '%".$ids[$i]."%' OR ";
			}
			$query = substr($query, 0, -4).") AND (estado = 1)";

			
		}
		else{
			return false;
		}*/
	}

	function get_estudiante_all($identificacion_estudiante){
		$this->db->select("p.*, tp.descripcion as tipo_prueba, ap.descripcion as alcance_prueba, cpp.id_participante_prueba");
		$this->db->from("core_participantes_pruebas cpp");
        $this->db->join("asignacion_participantes_prueba pp", "pp.id_participante = cpp.id_participante_prueba");
		$this->db->join("pruebas p", "p.id_prueba = pp.id_prueba");
		$this->db->join("alcance_prueba ap", "p.alcance_prueba = ap.id_alcance_prueba");
		$this->db->join("tipo_prueba tp", "p.tipo_prueba = tp.id_tipo_prueba");
		$this->db->where("cpp.identificacion", $identificacion_estudiante);
		$this->db->where("p.estado !=", 2);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get($id_prueba){
		$this->db->select("p.*, tp.descripcion as tipo_prueba, ap.descripcion as alcance_prueba, ap.id_alcance_prueba, tp.id_tipo_prueba");
		$this->db->from("pruebas p");
		$this->db->join("alcance_prueba ap", "p.alcance_prueba = ap.id_alcance_prueba");
        $this->db->join("tipo_prueba tp", "p.tipo_prueba = tp.id_tipo_prueba");
		$this->db->where("p.id_prueba", $id_prueba);
		$this->db->where("p.estado !=", 2);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	// Create a new test
	function create($data){
		$data["created_at"] = date("Y-m-d H:i:s");
		$this->db->insert("pruebas", $data);
		return $this->db->insert_id(); 
	}

	function update($data){
		$this->db->where("id_prueba", $data["id_prueba"]);
		return $this->db->update("pruebas", $data);
	}

	function get_count(){
        $this->db->select("COUNT(p.id_prueba) as cantidad_pruebas");
		$this->db->from("pruebas p");
		$this->db->where("p.estado !=", 2);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_count_by_materias($ids_materias, $alcance = "all"){
		$query = "";
		if(is_array($ids_materias)){
			$query = "(";
			for ($i=0; $i < count($ids_materias) ; $i++) { 
				$query.= "p.materias LIKE '%".$ids_materias[$i]."%' OR ";
			}
			$query = substr($query, 0, -4);
			$query.= ")";
		}
        $this->db->select("COUNT(p.id_prueba) as cantidad_pruebas");
		$this->db->from("pruebas p");
		$this->db->where($query, NULL, FALSE);
		$this->db->where("p.estado !=", 2);
		if($alcance != "all"){
			$this->db->where("p.alcance_prueba", $alcance);
		}
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function get_by_grado($grado, $institucion = null) {
		$this->db->select("p.*");
		$this->db->from("realizar_prueba rp");
		$this->db->join("pruebas p", "rp.id_prueba = p.id_prueba");
		if($institucion){
			$this->db->join("core_participantes_pruebas cpp", "cpp.id_participante_prueba = rp.id_participante");
			$this->db->where("cpp.institucion", $institucion);
		}
		$this->db->group_by("p.id_prueba");
		$this->db->where("rp.grado", strval($grado));
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : [];
	}
}