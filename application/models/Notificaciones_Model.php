<?php  
class Notificaciones_Model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    function create($data){
        $this->db->insert("notificaciones", $data);
        return $this->db->insert_id();
    }

    function update($data){
        $this->db->where("id_notificacion", $data["id_notificacion"]);
        return $this->db->update("notificaciones", $data);
    }

    function delete($idPeriodo){
        $this->db->where("id_notificacion", $idPeriodo);
        return $this->db->delete("notificaciones");
    }

    function find($idPeriodo){
        $this->db->where("id_notificacion", $idPeriodo);
        $this->db->from("notificaciones");
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	} 

    function getByDocente($idDocente, $query, $fecha = false){
        $this->db->select("n.*, cm.codmateria, cm.nommateria");
        $this->db->from("notificaciones n");
        $this->db->join("cfg_materias cm", "n.materia = cm.codmateria");
        $this->db->join("asg_materias am", "am.materia = cm.codmateria AND am.docente = $idDocente");
        if(count($query) >= 1){
            $add = ($fecha != false) ? "(" : "";
            $final = ($fecha != false && count($query) == 1) ? ")" : "";
            $this->db->where($add."(n.materia = '".$query[0]["materia"]."' AND n.grado = '".$query[0]["grado"]."' AND n.grupo = '".$query[0]["grupo"]."')$final");
        }
        if(count($query) > 1){
            for ($i=1; $i < count($query); $i++) { 
                $add = ($i == count($query) - 1 && $fecha != false) ? ")" : "";
                $this->db->or_where("(n.materia = '".$query[$i]["materia"]."' AND n.grado = '".$query[$i]["grado"]."' AND n.grupo = '".$query[$i]["grupo"]."')$add");
            }
        }
        if($fecha != false){
            $this->db->where("n.fecha >=", $fecha);
        }
        $this->db->group_by("n.id_notificacion");
        $this->db->limit(20);
        $this->db->order_by('fecha', 'desc');
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->result_array() : false;
	}   
}