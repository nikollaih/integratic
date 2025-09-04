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


    public function uncompleted($PlanAulaId = null)
    {
        // 1) Si llega PlanAulaId, obtenemos la materia del plan
        $planAula = false;
        if ($PlanAulaId !== null) {
            $q = $this->db->from('plan_areas')
                ->where('id_plan_area', $PlanAulaId)
                ->get();
            $planAula = ($q->num_rows() > 0) ? $q->row_array() : false;
        }

        // 2) Construimos el SELECT dinámico para los componentes (ec.* AS comp_*)
        $componentFields = $this->db->list_fields('evidencia_componentes'); // <- dinámico
        $select = ['ea.*', 'pa.materia'];
        foreach ($componentFields as $f) {
            $select[] = "ec.$f AS comp_$f";
        }

        $this->db->select($select);
        $this->db->from('evidencias_aprendizaje ea');
        $this->db->join(
            'evidencia_componentes ec',
            'ec.id_evidencia_aprendizaje = ea.id_evidencia_aprendizaje',
            'left'
        );

        if ($planAula) {
            $this->db->join('plan_areas pa', 'ea.id_plan_area = pa.id_plan_area', 'inner');
            $this->db->where('pa.materia', $planAula['materia']);
        } else {
            $this->db->join('plan_areas pa', 'ea.id_plan_area = pa.id_plan_area', 'left');
        }

        $this->db->where('ea.is_completo', 0);
        $this->db->order_by('ea.id_evidencia_aprendizaje', 'desc'); // quitamos orden por ec.id (puede no existir)

        $result = $this->db->get();
        if ($result->num_rows() === 0) {
            return false;
        }

        $rows = $result->result_array();
        $byEvidencia = [];

        foreach ($rows as $r) {
            $evidId = $r['id_evidencia_aprendizaje'];

            // Inicializa la evidencia si no existe aún
            if (!isset($byEvidencia[$evidId])) {
                // Copiamos todos los campos de ea.* y pa.materia
                $evid = $r;

                // Limpiamos del objeto principal todos los comp_* para no contaminar la evidencia
                foreach ($componentFields as $f) {
                    unset($evid["comp_$f"]);
                }

                $evid['componentes'] = [];
                $byEvidencia[$evidId] = $evid;
            }

            // ¿Existe un componente en esta fila? (todos comp_* vendrían NULL si no hay match)
            $hasComponent = false;
            foreach ($componentFields as $f) {
                if ($r["comp_$f"] !== null) {
                    $hasComponent = true;
                    break;
                }
            }

            if ($hasComponent) {
                // Reconstruimos el componente con sus nombres de campo originales
                $comp = [];
                foreach ($componentFields as $f) {
                    $comp[$f] = $r["comp_$f"];
                }
                $byEvidencia[$evidId]['componentes'][] = $comp;
            }
        }

        return array_values($byEvidencia);
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

    function findOne($idEvidenciaAprendizaje){
        $this->db->from("evidencias_aprendizaje ea");
        $this->db->where("ea.id_evidencia_aprendizaje", $idEvidenciaAprendizaje);
        $result = $this->db->get();

        if ($result->num_rows() === 0) {
            return false;
        }

        return $result->row_array();
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
