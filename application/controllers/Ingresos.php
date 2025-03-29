<?php
/**
 * @property $load
 * @property $Ingresos_Model
 * @property $Consultas_Model
 * @property $input
 * @property $Usuarios_Model
 */
class Ingresos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Ingresos_Model', 'Consultas_Model', 'Usuarios_Model']);
    }

    public function index(){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) === "super"){

                $params["fecha_inicial"] = NULL;
                $params["fecha_final"] = NULL;
                $params["rol"] = NULL;

                if($this->input->post()){
                    $params["fecha_inicial"] = $this->input->post("fecha_inicial");
                    $params["fecha_final"] = $this->input->post("fecha_final");
                    $params["rol"] = $this->input->post("rol");
                }

                $params["ingresos"] = $this->Ingresos_Model->getIngresos($params["fecha_inicial"], $params["fecha_final"], $params["rol"]);
                $params["roles"] = $this->Consultas_Model->getRoles();
                $this->load->view("ingresos/index", $params);
            }
        }
        else header('location: '.base_url());
    }

    public function usuario($id){
        if(is_logged()){
            if(strtolower(logged_user()["rol"]) === "super"){

                // Obtener fechas del formulario o establecer rango por defecto
                $fecha_inicial = $this->input->post("fecha_inicial");
                $fecha_final = $this->input->post("fecha_final");

                if (!$fecha_inicial || !$fecha_final) {
                    $fecha_inicial = date('Y-m-01'); // Primer día del mes
                    $fecha_final = date('Y-m-d');    // Hoy
                }

                // Estadísticas desde el modelo
                $params["fecha_inicial"] = $fecha_inicial;
                $params["fecha_final"] = $fecha_final;
                $params["documento"] = $id;

                $params["usuario"] = $this->Usuarios_Model->get_user($id);
                $params["ingresos"] = $this->Ingresos_Model->getIngresosUsuario($id, $fecha_inicial, $fecha_final);
                $params["total_ingresos"] = $this->Ingresos_Model->getTotalIngresosPorUsuario($id, $fecha_inicial, $fecha_final);
                $params["hora_promedio"] = $this->Ingresos_Model->getHoraPromedioIngreso($id, $fecha_inicial, $fecha_final);
                $params["ingresos_por_fecha"] = $this->Ingresos_Model->getIngresosPorFecha($id, $fecha_inicial, $fecha_final);
                $params["ingresos_por_dia_semana"] = $this->Ingresos_Model->getIngresosPorDiaSemana($id, $fecha_inicial, $fecha_final);
                $params["hora_promedio_por_fecha"] = $this->Ingresos_Model->getHoraPromedioPorFecha($id, $fecha_inicial, $fecha_final);

                // Datos generales
                $params["roles"] = $this->Consultas_Model->getRoles();

                // Cargar la vista
                $this->load->view("ingresos/usuario", $params);
            }
        } else {
            redirect(base_url());
        }
    }
}