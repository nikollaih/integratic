<?php
class Estudiante_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function getAll(){
		$this->db->from("estudiante e");
		$this->db->join("usuarios u", "e.documento = u.id", "left");
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getStudentsByDocuments($documentos){
		$this->db->from("estudiante");
		$this->db->where_in("documento", $documentos);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getStudentGrade($student_id){
		$student_grade = $this->db->query("select grado from estudiante where documento = $student_id");
		$student_grade = $student_grade->result()[0]->grado;
		return preg_replace('~\D~', '', $student_grade);
	}

	function getStudentGroupGrade($student_id){
		$student_grade = $this->db->query("select grado from estudiante where documento = $student_id");
		$student_grade = $student_grade->result()[0]->grado;
		return preg_replace('/[0-9]+/', '', $student_grade);
	}

	public function groupGradeAsignature($student_id, $mat){
		$group = $this->getStudentGroupGrade($student_id);
    $result = $this->db->query("Select * from asg_materias,cfg_materias,cfg_areas where materia=$mat and codarea=area and codmateria=materia and grupo='$group'");

    if(!$result) {return false;}
    else {return $result->result();}      
  }  

	function getAreas($student_id){
		$grade = $this->getStudentGrade($student_id);
		$result = $this->db->query("Select * from cfg_areas a left join cfg_materias m on a.codarea = m.area where a.tipo<>'gestion' and m.grado = $grade");
		if(!$result){
			return false;
		}else{
			return $result->result();
		}      
	}

	function getMaterias($student_id, $area_id){
		$grade = $this->getStudentGrade($student_id);
		$result = $this->db->query("Select * from cfg_materias,cfg_areas where area=$area_id and codarea=area and grado=$grade");
		if(!$result){
			return false;
		}else{
			return $result->result();
		}     
	}

	// Obtiene los anuncios de un grupo en especifico
	function getAnuncios($grado, $grupo, $date = null, $query = false){
		$this->db->from("cfg_materias m");
		$this->db->join("anuncios a", "m.codmateria = a.materia");
		$this->db->where("m.grado", $grado);
		$this->db->where("a.grupo", $grupo);

		if($date != null && $query == false){
			$this->db->where("a.created_at >", $date);
		}

		if($query){
			$this->db->limit(10);
		}

		$this->db->order_by("a.id_anuncio", "desc");

		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getStudentsByMateriaGroup($materia_group){
		$this->db->from("estudiante");
		$this->db->where("grado", $materia_group);
		$this->db->order_by("nombre", "asc");
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getStudentsByGrado($grado){
		$this->db->from("estudiante");
		$this->db->where("grado", $grado);
		$this->db->or_where("grado", strtolower($grado));
		$this->db->or_where("grado",  strtoupper($grado));
		$this->db->order_by("nombre", "asc");
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}
}