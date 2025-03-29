<?php
/**
 * @property $db
 * @property $load
 */
class Ingresos_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getIngresos($start_date = NULL, $end_date = NULL, $rol = NULL){
        $this->db->select("i.*, u.id, u.nombres, u.apellidos, u.email, e.grado, u.rol");
        $this->db->from("ingresos i");
        $this->db->join("usuarios u", "i.documento = u.id");
        $this->db->join("estudiante e", "u.id = e.documento", "left outer");
        if($start_date != NULL){
            $this->db->where("i.fecha >=", $start_date);
        }
        if($end_date != NULL){
            $this->db->where("i.fecha <=", $end_date);
        }
        if($rol != NULL){
            $this->db->where("u.rol", $rol);
        }

        $this->db->order_by("i.fecha", "desc");

        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    function getIngresosUsuario($id = NULL, $start_date = NULL, $end_date = NULL){
        $this->db->select("i.*, u.id, u.nombres, u.apellidos, u.email, e.grado, u.rol");
        $this->db->from("ingresos i");
        $this->db->join("usuarios u", "i.documento = u.id");
        $this->db->join("estudiante e", "u.id = e.documento", "left outer");
        if($start_date != NULL){
            $this->db->where("i.fecha >=", $start_date);
        }
        if($end_date != NULL){
            $this->db->where("i.fecha <=", $end_date);
        }
        if($id != NULL){
            $this->db->where("u.id", $id);
        }

        $this->db->order_by("i.fecha", "desc");

        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }


    // 1. Total de ingresos de un usuario en un rango de fechas
    function getTotalIngresosPorUsuario($id, $start_date = NULL, $end_date = NULL) {
        if ($start_date == NULL || $end_date == NULL) {
            $start_date = date('Y-m-01'); // primer día del mes actual
            $end_date = date('Y-m-d');    // hoy
        }
        $this->db->select("COUNT(*) as total");
        $this->db->from("ingresos");
        $this->db->where("documento", $id);
        if ($start_date) {
            $this->db->where("fecha >=", $start_date);
        }
        if ($end_date) {
            $this->db->where("fecha <=", $end_date);
        }
        $query = $this->db->get();
        return $query->row()->total;
    }

// 2. Hora promedio de ingreso (formato HH:MM:SS)
    function getHoraPromedioIngreso($id, $start_date = NULL, $end_date = NULL) {
        if ($start_date == NULL || $end_date == NULL) {
            $start_date = date('Y-m-01'); // primer día del mes actual
            $end_date = date('Y-m-d');    // hoy
        }
        $this->db->select("SEC_TO_TIME(AVG(TIME_TO_SEC(hora))) as hora_promedio", false);
        $this->db->from("ingresos");
        $this->db->where("documento", $id);
        if ($start_date) {
            $this->db->where("fecha >=", $start_date);
        }
        if ($end_date) {
            $this->db->where("fecha <=", $end_date);
        }
        $query = $this->db->get();
        return $query->row()->hora_promedio;
    }

// 3. Cantidad de ingresos por fecha (para gráfico de barras)
    function getIngresosPorFecha($id, $start_date = NULL, $end_date = NULL) {
        if ($start_date == NULL || $end_date == NULL) {
            $start_date = date('Y-m-01'); // primer día del mes actual
            $end_date = date('Y-m-d');    // hoy
        }
        $this->db->select("fecha, COUNT(*) as cantidad");
        $this->db->from("ingresos");
        $this->db->where("documento", $id);
        if ($start_date) {
            $this->db->where("fecha >=", $start_date);
        }
        if ($end_date) {
            $this->db->where("fecha <=", $end_date);
        }
        $this->db->group_by("fecha");
        $this->db->order_by("fecha", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

// 4. Cantidad de ingresos por día de la semana (para gráfico circular)
    function getIngresosPorDiaSemana($id, $start_date = NULL, $end_date = NULL) {
        if ($start_date == NULL || $end_date == NULL) {
            $start_date = date('Y-m-01'); // primer día del mes actual
            $end_date = date('Y-m-d');    // hoy
        }
        $this->db->select("DAYNAME(fecha) as dia_semana, COUNT(*) as cantidad", false);
        $this->db->from("ingresos");
        $this->db->where("documento", $id);
        if ($start_date) {
            $this->db->where("fecha >=", $start_date);
        }
        if ($end_date) {
            $this->db->where("fecha <=", $end_date);
        }
        $this->db->group_by("dia_semana");
        $query = $this->db->get();
        return $query->result_array();
    }

// 5. Hora promedio por día (para gráfico de línea)
    function getHoraPromedioPorFecha($id, $start_date = NULL, $end_date = NULL) {
        if ($start_date == NULL || $end_date == NULL) {
            $start_date = date('Y-m-01'); // primer día del mes actual
            $end_date = date('Y-m-d');    // hoy
        }
        $this->db->select("fecha, SEC_TO_TIME(AVG(TIME_TO_SEC(hora))) as hora_promedio", false);
        $this->db->from("ingresos");
        $this->db->where("documento", $id);
        if ($start_date) {
            $this->db->where("fecha >=", $start_date);
        }
        if ($end_date) {
            $this->db->where("fecha <=", $end_date);
        }
        $this->db->group_by("fecha");
        $this->db->order_by("fecha", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

}
