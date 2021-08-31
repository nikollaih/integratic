<?php
    if(!function_exists('load_answer'))
    {
        function load_answer($respuesta, $margin = 0, $id, $count_answers = 0){
            $dom_answers = ($count_answers > 0) ? '<div data-toggle="'.$id.'" class="show-hide-answers-foro answer-toggle"><i class="fa fa-eye"></i><p>Mostrar Respuestas ('.$count_answers.')</p></div>' : '';
           return 
            '<li style="list-style:none;margin-bottom: 10px;">'.
                    '<div class="card mb-4">'.
                        '<div class="card-header">'.
                            '<div class="media flex-wrap w-100 align-items-center" style="position:relative;">'.
                                '<div class="media-body ml-3"> <a data-abc="true" style="font-weight:bold;">'.$respuesta["nombres"].' '.$respuesta["apellidos"] .'</a>'.
                                    '<div class="text-muted small">'.date("Y-m-d, h:i a", strtotime($respuesta["created_at"])) .'</div>'.
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