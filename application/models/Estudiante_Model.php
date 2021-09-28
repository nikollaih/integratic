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

}