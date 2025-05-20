<?php  
class EvidenciasAprendizaje_Model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    function create($data){
        unset($data['id_evidencia_aprendizaje']);
        $this->db->insert("evidencias_aprendizaje", $data);
        return $this->db->insert_id();
    }

    function update($data){
        $this->db->where("id_evidencia_aprendizaje", $data["id_evidencia_aprendizaje"]);
        return $this->db->update("evidencias_aprendizaje", $data);
    }

    function getByPlanArea($idPlanArea) {
        $this->db->from("evidencias_aprendizaje ea");
        $this->db->join("evidencia_componentes ec", "ea.id_evidencia_aprendizaje = ec.id_evidencia_aprendizaje");
        $this->db->where("ea.id_plan_area", $idPlanArea);
        $result = $this->db->get();

        if ($result->num_rows() === 0) {
            return false;
        }

        $rawData = $result->result_array();
        $evidencias = [];

        foreach ($rawData as $row) {
            $id = $row['id_evidencia_aprendizaje'];

            // Si aún no existe esta evidencia, inicializamos
            if (!isset($evidencias[$id])) {
                $evidencias[$id] = $row;
            }

            // Agregamos el componente
            $evidencias[$id]['componentes'][] = $row;
        }

        // Reindexar para devolver un array sin claves asociativas
        return array_values($evidencias);
    }


    function uncompleted(){
        $this->db->from("evidencias_aprendizaje ea");
        $this->db->where("ea.is_completo", 0);
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    // Obtiene la lista de evidencias de aprendizaje basados
    // en los fintros establecidos por el usuario
    function get_by_filter($area = null, $materia = null, $semana = null, $periodo = null, $estado = null, $docente = null){
        $this->db->from("evidencias_aprendizaje ea");
        $this->db->join("plan_areas pa", "ea.id_plan_area = pa.id_plan_area");
        $this->db->join("usuarios u", "u.id = pa.created_by");
        $this->db->join("cfg_areas ca", "ca.codarea = pa.area");
        $this->db->join("cfg_materias cm", "cm.codmateria = pa.materia");
        $this->db->join("periodos p", "p.id_periodo = pa.periodo");

        // Aplica filtro de docente
        if($docente != null){
            $this->db->where("pa.created_by", $docente);
        }

        // Aplica filtro de área
        if($area != null){
            $this->db->where("pa.area", $area);
        }

        // Aplica filtro de materia
        if($materia != null){
            $this->db->where("pa.materia", $materia);
        }

        // Aplica filtro de periodo
        if($periodo != null && $semana == null){
            $this->db->where("pa.periodo", $periodo);
        }

        // Aplica filtro de estado
        if($estado != null){
            $this->db->where("ea.estado_completo", $estado);
        }

        // Aplica filtro de semana
        if($semana != null){
            $this->db->where("ea.semanas LIKE '%\"".$semana."\"%'", NULL, FALSE);
        }
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function getBySemanasPeriodo($semanasIDS){
        $this->db->from("evidencias_aprendizaje ea");
        if(is_array($semanasIDS)){
            $this->db->like("ea.semanas", '"'.$semanasIDS[0].'"', "both");
        }
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}

    function find($idEvidenciaAprendizaje){
        // Hacemos el join con la tabla de componentes
        $this->db->from("evidencias_aprendizaje ea");
        $this->db->join("evidencia_componentes ec", "ea.id_evidencia_aprendizaje = ec.id_evidencia_aprendizaje");
        $this->db->where("ea.id_evidencia_aprendizaje", $idEvidenciaAprendizaje);
        $result = $this->db->get();

        if ($result->num_rows() === 0) {
            return false;
        }

        $rawData = $result->result_array();
        $data = [];

        // La evidencia es única, así que podemos tomarla del primer row
        $data = $rawData[0];

        // Limpiamos posibles claves duplicadas de join (si es necesario)
        // Luego inicializamos la lista de componentes
        $data['componentes'] = [];

        foreach ($rawData as $row) {
            $componente = $row;
            $data['componentes'][] = $componente;
        }

        return $data;
    }


    function delete($idEvidenciaAprendizaje){
        $this->db->where("id_evidencia_aprendizaje", $idEvidenciaAprendizaje);
        return $this->db->delete("evidencias_aprendizaje");
    }

    function deleteByPlanAula($idPlanAula){
        $this->db->where("id_plan_area", $idPlanAula);
        return $this->db->delete("evidencias_aprendizaje");
    }
} 
