<?php
class Estudiante_Model extends CI_Model {

  	public function __construct() {
   	 	parent::__construct();
    	$this->load->database();
 	}

	function getAll(){
		$this->db->select("u.*, e.*, e.email as email, cer.id_pregunta");
		$this->db->from("estudiante e");
		$this->db->join("usuarios u", "e.documento = u.id", "left");
        $this->db->join("caracterizacion_estudiantes_respuestas cer", "cer.id_estudiante = u.id", "left outer");
		$this->db->order_by("e.grado", "asc");
		$this->db->order_by("e.nombre", "asc");
        $this->db->group_by("e.documento");
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getAllStudents(){
		$this->db->from("estudiante e");
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getStudentsByDocuments($documentos){
		$this->db->from("estudiante");
		$this->db->where_in("documento", $documentos);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function getStudentUserByDocument($document){
		$this->db->from("estudiante e");
		$this->db->join("usuarios u", "u.id = e.documento");
		$this->db->where("e.documento", $document);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function getStudentUserByDocumentGrado($document, $grado){
		$this->db->from("estudiante e");
		$this->db->join("usuarios u", "u.id = e.documento");
		$this->db->where("e.documento", $document);
		$this->db->where("e.grado", $grado);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function getStudentGrade($student_id){
		$student_grade = $this->db->query("select grado from estudiante where documento = '".$student_id."'");
		$student_grade = trim($student_grade->result()[0]->grado);
		return substr($student_grade, 0, intval(strlen($student_grade)) - 1);
	}

	function getStudentGroupGrade($student_id){
		$student_grade = $this->db->query("select grado from estudiante where documento = '".$student_id."'");
		$student_grade = trim($student_grade->result()[0]->grado);
		return trim(substr($student_grade, intval(strlen($student_grade)) - 1, intval(strlen($student_grade))));
	}

	public function groupGradeAsignature($student_id, $mat){
		$group = $this->getStudentGroupGrade($student_id);
    $result = $this->db->query("Select u.nombres, u.apellidos, am.*, cm.*, ca.* from asg_materias am join cfg_materias cm on am.materia = cm.codmateria join cfg_areas ca on cm.area = ca.codarea join usuarios u on u.id = am.docente where materia='".$mat."' and codarea=area and codmateria=materia and grupo='".$group."'");

    if(!$result) {return false;}
    else {return $result->result();}      
  }  

	function getAreas($student_id){
		$grade = $this->session->userdata()["logged_in"]["grado"];
		$grupo = $this->session->userdata()["logged_in"]["grupo"];
		$result = $this->db->query("Select * from cfg_areas a left join cfg_materias m on a.codarea = m.area join asg_materias am on am.materia = m.codmateria where m.grado = '".$grade."' and am.grupo = '".$grupo."' group by a.codarea");
		if(!$result){
			return false;
		}else{
			return $result->result();
		}      
	}

	function getMaterias($student_id, $area_id){
		$grade = $this->getStudentGrade($student_id);
		$result = $this->db->query("Select * from cfg_materias,cfg_areas where area=$area_id and codarea=area and grado='".$grade."'");
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

	function setImportedStudents($estudiantes){
		return $this->db->insert_batch("estudiante", $estudiantes);
	}

	function delete_all_estudents(){
		$this->db->where("documento !=", "-99");
		return $this->db->delete("estudiante");
	}

	function delete($documento){
		$this->db->where("documento", $documento);
		return $this->db->delete("estudiante");
	}

	function update($data){
		$this->db->where("documento", $data["documento"]);
		return $this->db->update("estudiante", $data);
	}

	function add($data){
		return $this->db->insert("estudiante", $data);
	}

	function update_old($id, $data){
		$this->db->where("documento", $id);
		return $this->db->update("estudiante", $data);
	}

	function getGrados($onlyGrados = false){
        if($onlyGrados){
            $this->db->select("grado");
        }
		$this->db->from("estudiante");
		$this->db->group_by("grado");
		$this->db->order_by("grado", "asc");
		$result = $this->db->get();

		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function getCaracterizacionEstudiantesFilters($filters) {
        // Construir la subconsulta aplicando los filtros
        $subquery = $this->db->select('cer.id_estudiante, JSON_ARRAYAGG(JSON_OBJECT("id_pregunta", cer.id_pregunta, "respuesta", cer.respuesta)) as caracterizacion_respuestas')
            ->from('caracterizacion_estudiantes_respuestas cer')
            ->group_by('cer.id_estudiante')
            ->get_compiled_select();

// Construir la subconsulta para contar coincidencias de filtros
        $filter_query = $this->db->select('id_estudiante')
            ->from('caracterizacion_estudiantes_respuestas');


        $countFilters = count($filters);

        foreach ($filters as $id_pregunta => $respuesta) {
            if (!empty($respuesta)) {
                $filter_query->group_start();
                $countFilters++; // Contar el filtro para este id_pregunta
                if (is_array($respuesta)) {
                    $filter_query->or_group_start();
                    foreach ($respuesta as $filter) {
                        $filter_query->group_start()
                            ->where('id_pregunta', $id_pregunta)
                            ->like('respuesta', $filter, 'both')
                            ->group_end();
                        $filter_query->having('SUM(CASE WHEN id_pregunta = ' . $id_pregunta . ' AND respuesta LIKE ' . $this->db->escape('%' . $filter . '%') . ' THEN 1 ELSE 0 END) > 0');
                    }
                    $filter_query->group_end();
                } else {
                    $filter_query->or_group_start()
                        ->where('id_pregunta', $id_pregunta)
                        ->like('respuesta', $respuesta, 'both')
                        ->group_end();
                    $filter_query->having('SUM(CASE WHEN id_pregunta = ' . $id_pregunta . ' AND respuesta LIKE ' . $this->db->escape('%' . $respuesta . '%') . ' THEN 1 ELSE 0 END) > 0');
                }

                $filter_query->group_end();
            }

        }

// Agrupación final y condición de HAVING para contar los filtros
        $filter_query = $filter_query->group_by('id_estudiante')
            ->get_compiled_select();

// Construir la consulta final
        $this->db->select("u.*, e.*, e.email as email, cer_responses.caracterizacion_respuestas");
        $this->db->from("estudiante e");
        $this->db->join("usuarios u", "e.documento = u.id", "left");
        $this->db->join("($subquery) as cer_responses", "cer_responses.id_estudiante = u.id", "left outer");
        $this->db->join("($filter_query) as filter_matches", "filter_matches.id_estudiante = u.id", "inner");
        $this->db->order_by("e.grado", "asc");
        $this->db->order_by("e.nombre", "asc");
        $this->db->group_by("e.documento");

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function getCaracterizacionEstudiantes($grado = false) {
        // Construir la subconsulta aplicando los filtros
        $subquery = $this->db->select('cer.id_estudiante, JSON_ARRAYAGG(JSON_OBJECT("id_pregunta", cer.id_pregunta, "respuesta", cer.respuesta)) as caracterizacion_respuestas')
            ->from('caracterizacion_estudiantes_respuestas cer')
            ->group_by('cer.id_estudiante')
            ->get_compiled_select();

        $this->db->select("u.*, e.*, e.email as email, cer_responses.caracterizacion_respuestas");
        $this->db->from("estudiante e");
        $this->db->join("usuarios u", "e.documento = u.id", "left");
        $this->db->join("($subquery) as cer_responses", "cer_responses.id_estudiante = u.id", "left outer");

        if($grado) {
            $this->db->where("e.grado", $grado);
        }

        $this->db->order_by("e.grado", "asc");
        $this->db->order_by("e.nombre", "asc");
        $this->db->group_by("e.documento");

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}