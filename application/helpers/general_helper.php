<?php
    if(!function_exists('mover_estudiantes_usuarios'))
    {
        function mover_estudiantes_usuarios(){
            $CI = &get_instance();
            $CI->load->model(['Estudiante_Model', 'General_Model']);
            
            $estudiantes = $CI->Estudiante_Model->getAll();
            
            if(is_array($estudiantes)){
                foreach ($estudiantes as $e) {
                    $temp_name = explode(" ", $e["nombre"]);
                    $split_name = [];
                    for ($i=0; $i < count($temp_name); $i++) { 
                        if(trim($temp_name[$i]) != ""){
                            array_push($split_name, $temp_name[$i]);
                        }
                    }

                    $data["nombres"] = (count($split_name) == 4) ? $split_name[2] . " " . $split_name[3] : $split_name[2];
                    $data["apellidos"] = $split_name[0] . " " . $split_name[1];
                    $data["id"] = $e["documento"];
                    $data["cargo"] = "Estudiante";
                    $data["rol"] = "Estudiante";
                    $data["usuario"] = $e["documento"];
                    $data["clave"] =  $e["documento"];
                    $data["estado"] = "ac";


                   $CI->General_Model->insertar("usuarios", $data);
                }

                
            }
        }
    
    }
?>