<?php
    if(!function_exists('load_answer'))
    {
        function load_answer($respuesta, $margin = 0, $id, $count_answers = 0){
            $boton_eliminar = ($respuesta["created_by"] == logged_user()["id"]) ? 
                '<a style="background: #ff5c5c;cursor:pointer;" class="small-btn d-flex align-items-center button-eliminar-respuesta-foro" data-respuesta-foro="'. $respuesta["id_respuesta"] .'">'.
                    '<i class="fa fa-trash"></i>'.
                    '<p style="margin:0px 0PX 0PX 7PX;">Eliminar</p>'.
                '</a>' : "";

            $dom_answers = ($count_answers > 0) ? '<div data-toggle="'.$id.'" class="show-hide-answers-foro answer-toggle"><i class="fa fa-eye"></i><p>Mostrar Respuestas ('.$count_answers.')</p></div>' : '';
           return 
            '<li style="list-style:none;" id="respuesta-foro-'.$respuesta["id_respuesta"].'">'.
                    '<div class="card mb-4 item-foro">'.
                        '<div class="card-header">'.
                            '<div class="media flex-wrap w-100 align-items-center" style="position:relative;">'.
                                '<div class="d-flex justify-between align-items-center">'.
                                    '<div class="media-body ml-3"> 
                                        <a data-abc="true" style="font-weight:bold;">'.$respuesta["nombres"].' '.$respuesta["apellidos"] .'</a>'.
                                        '<div class="text-muted small">'.date("Y-m-d, h:i a", strtotime($respuesta["created_at"])) .'</div>'.
                                    '</div>'.
                                    $boton_eliminar.
                                '</div>'.
                                $dom_answers.
                            '</div>'.  
                        '</div>'.
                        '<div class="card-body">'.
                            '<p>'.$respuesta["descripcion"].'</p>'.
                        '</div>'.
                        '<div class="px-4 pt-3"> <button data-toggle="modal" data-target="#agregar-respuesta-foro" type="button" data-type="respuesta" data-id="'. $respuesta["id_respuesta"] .'" class="btn btn-primary agregar-respuesta-foro" style="margin:10px;><i class="fa fa-plus"></i>&nbsp; Agregar Respuesta</button> </div>'.
                    '</div>'.
                '</li>';
        }
    
    }
?>