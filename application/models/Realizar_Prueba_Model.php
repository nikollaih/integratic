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
		$this->db->join("core_participantes_pruebas cpp", "rp.id_participante = cpp.id_participante_prueba");
		$this->db->join("instituciones_educativas ie", "cpp.institucion = ie.id_institucion_educativa", "left");
		$this->db->join("municipios m", "m.id_municipio = ie.id_municipio", "left");
		$this->db->where("rp.id_participante", $id_participante);
		$this->db->group_by("p.id_prueba");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}


	function get_by_participante_materia($id_participante, $materia){
		$this->db->from("realizar_prueba rp");
		$this->db->join("pruebas p", "p.id_prueba = rp.id_prueba");
		$this->db->join("core_participantes_pruebas cpp", "rp.id_participante = cpp.id_participante_prueba");
		$this->db->join("instituciones_educativas ie", "cpp.institucion = ie.id_institucion_educativa", "left");
		$this->db->join("municipios m", "m.id_municipio = ie.id_municipio", "left");
		$this->db->where("cpp.identificacion", $id_participante);
		$this->db->group_by("p.id_prueba");
		$this->db->where("(p.materias LIKE '%".$materia."%' )", NULL, FALSE);

		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function get_by_participante_materia_tipo_temas($id_participante, $materia, $tipo, $temas = null){
        $this->db->from("realizar_prueba rp");
        $this->db->join("pruebas p", "p.id_prueba = rp.id_prueba");
        $this->db->join("core_participantes_pruebas cpp", "rp.id_participante = cpp.id_participante_prueba");
        $this->db->join("instituciones_educativas ie", "cpp.institucion = ie.id_institucion_educativa", "left");
        $this->db->join("municipios m", "m.id_municipio = ie.id_municipio", "left");
        $this->db->where("cpp.identificacion", $id_participante);
        $this->db->group_by("p.id_prueba");
        $this->db->where("(p.materias LIKE '%".$materia."%' )", NULL, FALSE);
        $this->db->where("p.tipo_prueba", $tipo);
        if($temas != null){
            for ($i = 0; $i < count($temas); $i++) {
                $this->db->where("(p.temas LIKE '%".$temas[$i]."%' )", NULL, FALSE);
            }
        }

        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function create($data){
      if($data["id_prueba"] > 0){
          $data["created_at"] = date("Y-m-d H:i:s");
          $this->db->insert("realizar_prueba", $data);
          return $this->get_by_id($this->db->insert_id());
      }
      return null;
    }

	function update($data){
		$this->db->where("id_realizar_prueba", $data["id_realizar_prueba"]);
		return $this->db->update("realizar_prueba", $data);
	}

	function delete($id_realizar_prueba){
		$this->db->where("id_realizar_prueba", $id_realizar_prueba);
		return $this->db->delete("realizar_prueba");
	}

	function get_aprobadas($ids_materias, $tipo = true, $alcance = "all", $value = 60){
		$query = "";
		if(is_array($ids_materias)){
			$query = "(";
			for ($i=0; $i < count($ids_materias) ; $i++) { 
				$query.= "p.materias LIKE '%".$ids_materias[$i]."%' OR ";
			}
			$query = substr($query, 0, -4);
			$query.= ")";
		}
		$this->db->from("realizar_prueba rp");
		$this->db->join("pruebas p", "p.id_prueba = rp.id_prueba");
		if($tipo){
			$this->db->where("rp.calificacion >= ", $value);
		}
		else{
			$this->db->where("rp.calificacion < ", $value);
		}
		if($alcance != "all"){
			$this->db->where("p.alcance_prueba", $alcance);
		}
		$this->db->where($query, NULL, FALSE);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_by_municipios(){
		$this->db->select("m.*");
		$this->db->from("realizar_prueba rp");
		$this->db->join("core_participantes_pruebas cpp", "rp.id_participante = cpp.id_participante_prueba");
		$this->db->join("municipios m", "m.id_municipio = cpp.municipio", "left");
		$this->db->group_by("m.id_municipio");
		$this->db->where("m.id_municipio >", 0);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_aprobados_by_municipios($municipio, $tipo = true){
		$this->db->select("m.*");
		$this->db->from("realizar_prueba rp");
		$this->db->join("core_participantes_pruebas cpp", "rp.id_participante = cpp.id_participante_prueba");
		$this->db->join("municipios m", "m.id_municipio = cpp.municipio", "left");
		$this->db->where("m.id_municipio", $municipio);
		if($tipo){
			$this->db->where("rp.calificacion >= ", 60);
		}
		else{
			$this->db->where("rp.calificacion < ", 60);
		}
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : [];
	}

	function get_by_instituciones($idMunicipio){
		$this->db->select("ie.*");
		$this->db->from("realizar_prueba rp");
		$this->db->join("core_participantes_pruebas cpp", "rp.id_participante = cpp.id_participante_prueba");
		$this->db->join("municipios m", "m.id_municipio = cpp.municipio", "left");
		$this->db->join("instituciones_educativas ie", "m.id_municipio = ie.id_municipio", "left");
		$this->db->group_by("ie.id_institucion_educativa");
		$this->db->where("ie.id_institucion_educativa >", 0);
		$this->db->where("m.id_municipio", $idMunicipio);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

	function get_aprobados_by_instituciones($idInstitucion, $tipo = true){
		$this->db->select("ie.*");
		$this->db->from("realizar_prueba rp");
		$this->db->join("core_participantes_pruebas cpp", "rp.id_participante = cpp.id_participante_prueba");
		$this->db->join("instituciones_educativas ie", "cpp.institucion = ie.id_institucion_educativa", "left");
		$this->db->join("municipios m", "m.id_municipio = ie.id_municipio");
		$this->db->group_by("ie.id_institucion_educativa");
		$this->db->where("ie.id_institucion_educativa", $idInstitucion);
		if($tipo){
			$this->db->where("rp.calificacion >= ", 60);
		}
		else{
			$this->db->where("rp.calificacion < ", 60);
		}
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : [];
	}

	function get_aprobados_by_grado_area($grado, $materias, $tipo = true, $institucion = null) {
		$this->db->select("rp.*, p.materias");
		$this->db->from("realizar_prueba rp");
		$this->db->join("pruebas p", "p.id_prueba = rp.id_prueba");
		if($institucion){
			$this->db->join("core_participantes_pruebas cpp", "cpp.id_participante_prueba = rp.id_participante");
			$this->db->where("cpp.institucion", $institucion);
		}
		$this->db->group_by("rp.id_realizar_prueba");
		$this->db->where("rp.grado", $grado);
		$query = "";
		if(is_array($materias)){
			$query = "(";
			for ($i=0; $i < count($materias) ; $i++) { 
				$query.= "p.materias LIKE '%".$materias[$i]."%' OR ";
			}
			$query = substr($query, 0, -4);
			$query.= ")";
		}

		if($tipo){
			$this->db->where("rp.calificacion >= ", 60);
		}
		else{
			$this->db->where("rp.calificacion < ", 60);
		}
		$this->db->where($query, NULL, FALSE);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : [];
	}
}