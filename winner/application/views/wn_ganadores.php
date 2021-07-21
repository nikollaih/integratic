<div class="container">	      	    			      		
      <div class="widget ">	    			
          <div class="widget-header">
              <i class="icon-user"></i>
              <h3>Gestión de Ganadores</h3>
          </div> <!-- /widget-header -->	

          <div class="widget-content"> 
            <div class="span8">    
                <div class="widget-header"> <i class="icon-list-alt"></i>
                    <h3>Filtros disponibles</h3> 
                </div>
                <div class="widget-content">
                    <div class="widget big-stats-container"> 
                        <select id="filtros" name="filtros" class="span3" onchange="javascript:cambia_dato()">
                            <option selected disabled>Seleccione Filtro</option>                            
                            <option value="2">Estrato</option>
                            <option value="3">Genero</option> 
                            <option value="4">Municipio</option> 
                            <option value="1">Comuna</option>                            
                            <option value="5">Barrio</option>
                            <option value="6">Locutor</option>
                            <option value="7">Edad</option>
                        </select>
                        &emsp;&emsp;&emsp;
                        <select id="operador" name="operador" class="span1">
                            <option value="=">=</option>
                            <option value="<"><</option>
                            <option value=">">></option>                           
                            <option value="<>"><></option>
                            <option value="like">como</option>
                        </select>   
                        <input id="muni" name="muni" type="hidden"/>                  
                        <div id="cambia_dato"><input id="dato" name="dato" type="text" disabled/></div>
                        &emsp;&emsp;&emsp;
                        <a href="javascript:ag_filtro();" class="btn btn-small btn-success "><i class="btn-icon-only icon-ok"></i></a>
                    </div>
                </div> 
                <br>                                                                                  
            </div>                
            <div class="span3">    
                <div class="widget-header"> <i class="icon-list-alt"></i>
                    <h3>Filtros Aplicados</h3> 
                </div>
                <div class="widget-content">
                    <div class="widget big-stats-container"> 
                    <table id="tb_filtros" border="0" class="span2" style="text-align: center">
                    </table>             
                    </div>
                    <div id="btn_resul">
                        <button class="btn-small btn-success span2">
                            <div id="numero">0 Resultados</div></button>
                    </div>
                </div>                                                      
            </div>  


         
            <div class="span11">    
                <div class="widget-header"> <i class="icon-list-alt"></i>
                    <h3>Filtros disponibles</h3> 
                </div>
                <div class="widget-content">
                    <div id="listado" class="widget big-stats-container"> 
  
                    </div>
                </div> 
                <br>                                                                                 
            </div>                
          </div> <!-- /widget -->
    </div> <!-- /span8 -->                                      
</div>  
<script> 
  
function ag_filtro(){
    var combo      = document.getElementById("filtros");
    var opcion     = combo.options[combo.selectedIndex].text;  
    var combo      = document.getElementById("operador");
    var opera      = combo.options[combo.selectedIndex].text;        
    var table      = document.getElementById("tb_filtros"); 
    var num        = document.getElementById("tb_filtros").rows.length;      
    var row        = table.insertRow(num);
    var campo0 = row.insertCell(0);
        texto="<input value="+num+" type='hidden'><a href='javascript:;' class='btn btn-invert btn-small'>"
        texto+=opcion+" "+opera+" "+document.getElementById("dato").value;
        texto+="<i class='btn-icon-only icon-remove'>"; 
    campo0.innerHTML = texto;
   var com="N",est="N",gen="N",mun="N",bar="N",loc="N",eda="N";
   var ocom="N",oest="N",ogen="N",omun="N",obar="N",oloc="N",oeda="N";
   var pcom="N",pest="N",pgen="N",pmun="N",pbar="N",ploc="N",peda="N";
    for(i=0;i<=num;i++){
        var nueva = document.getElementById("tb_filtros").rows[i].cells[0].innerText;  
        var tabla = nueva.split(" ",1);     
        if(new String(tabla).valueOf()==new String("Comuna").valueOf()){
            var cad=nueva.split(" ");
            var com="S";
            var ocom=cad[1];
            switch(ocom){
                case"=" :ocom="IG";break;
                case"<>":ocom="DI";break;
                case">" :ocom="MA";break;
                case"<" :ocom="ME";break;
            }            
            var pcom=cad[2];
        }       
        if(new String(tabla).valueOf()==new String("Estrato").valueOf()){
            var cad=nueva.split(" ");
            var est="S";
            var oest=cad[1];
            switch(oest){
                case"=" :oest="IG";break;
                case"<>":oest="DI";break;
                case">" :oest="MA";break;
                case"<" :oest="ME";break;
            }             
            var pest=cad[2];
        }  
        if(new String(tabla).valueOf()==new String("Genero").valueOf()){
            var cad=nueva.split(" ");
            var gen="S";
            var ogen=cad[1];
            switch(ogen){
                case"=" :ogen="IG";break;
                case"<>":ogen="DI";break;
                case">" :ogen="MA";break;
                case"<" :ogen="ME";break;
            }             
            var pgen=cad[2];
        }                            
        if(new String(tabla).valueOf()==new String("Municipio").valueOf()){
            var cad=nueva.split(" ");
            var mun="S";
            var omun=cad[1];
            switch(omun){
                case"=" :omun="IG";break;
                case"<>":omun="DI";break;
                case">" :omun="MA";break;
                case"<" :omun="ME";break;
            }
            var pmun=cad[2];
        }    
        if(new String(tabla).valueOf()==new String("Barrio").valueOf()){
            var cad=nueva.split(" ");
            var bar="S";
            var obar=cad[1];
            switch(obar){
                case"=" :obar="IG";break;
                case"<>":obar="DI";break;
                case">" :obar="MA";break;
                case"<" :obar="ME";break;
            }             
            var pbar=cad[2];
        }        
        if(new String(tabla).valueOf()==new String("Locutor").valueOf()){
            var cad=nueva.split(" ");
            var loc="S";
            var oloc=cad[1];
            switch(oloc){
                case"=" :oloc="IG";break;
                case"<>":oloc="DI";break;
                case">" :oloc="MA";break;
                case"<" :oloc="ME";break;
            }             
            var ploc=cad[2];
        }    
        if(new String(tabla).valueOf()==new String("Edad").valueOf()){
            var cad=nueva.split(" ");
            var eda="S";
            var oeda=cad[1];
            switch(ocom){
                case"=" :oeda="IG";break;
                case"<>":oeda="DI";break;
                case">" :oeda="MA";break;
                case"<" :oeda="ME";break;
            }             
            var peda=cad[2];
        }                       
    }                        
    var url='<?=site_url();?>/consulta/co_ganador/'+com+'/'+est+'/'+gen+'/'+mun+'/'+bar+'/'+loc+'/'+eda+'/'+ocom+'/'+oest+'/'+ogen+'/'+omun+'/'+obar+'/'+oloc+'/'+oeda+'/'+pcom+'/'+pest+'/'+pgen+'/'+pmun+'/'+pbar+'/'+ploc+'/'+peda;
        $.ajax({
                url:url,
                type:'POST',
                success:function(respuesta){
                    var registros = eval(respuesta);                   
                    html=registros.length+" Resultados";
                    $("#numero").html(html);
                    html='<table class="table table-striped table-bordered span10 id="tb_inscritos">';
                    html+='<thead><th style="width:10%;text-align:center;">Documento</th>';
                    html+='<th style="width:30%;">Nombre Completo</th>';
                    html+='<th style="width:30%;text-align:center;">Dirección</th>';
                    html+='<th style="width:20%;text-align:center;">Barrio</th>';
                    html+='<th style="width:5%;text-align:center;">Comuna</th>';
                    html+='<th style="width:5%;text-align:center;">Estrato</th>';
                    html+='<th style="width:10%;text-align:center;">Ciudad</th>';
                    html+='<th style="width:10%;text-align:center;">Premio</th>';
                    html+='</thead>';

                    for (i=0; i<registros.length; i++) { 
                          html+='<tr><td style="width:10%;text-align:center;">'+registros[i]["DOCUMENTO"]+'</td>';
                          html+='<td>'+registros[i]["NOMBRE"]+'</td>';
                          html+='<td>'+registros[i]["DIRECCION"]+'</td>';
                          html+='<td>'+registros[i]["BARRIO"]+'</td>';
                          html+='<td>'+registros[i]["COMUNA"]+'</td>';
                          html+='<td>'+registros[i]["ESTRATO"]+'</td>';
                          html+='<td>'+registros[i]["CIUDAD"]+'</td>';
                          html+='<td><a href="javascript:ag_filtro();" class="btn btn-small btn-success "><i class="btn-icon-only icon-ok"></i></a></i></td>'

                          html+='</tr>';                        
                    }                     
                    html+='</table>'; 
                    $("#listado").html(html);
                },
            error:function(respuesta){
                    alert("Error: "+respuesta);}                  
        });      
                         
}
function cambia_dato(){
    var combo      = document.getElementById("filtros");
    var opcion     = combo.options[combo.selectedIndex].value;    
     switch(opcion){
        case '1':
            html='<select id="dato" name="dato" class="span3">';
            html+='<option value="1">Comuna 1</option>';
            html+='<option value="2">Comuna 2</option>';
            html+='<option value="3">Comuna 3</option>';
            html+='<option value="4">Comuna 4</option>';
            html+='<option value="5">Comuna 5</option>';
            html+='<option value="6">Comuna 6</option>';
            html+='<option value="7">Comuna 7</option>';
            html+='<option value="8">Comuna 8</option>';
            html+='<option value="9">Comuna 9</option>';
            html+='<option value="10">Comuna 10</option>';
            html+='</select>';                         
            break;
        case '2':
            html='<select id="dato" name="dato" class="span3">';
            html+='<option value="1">Estrato 1</option>';
            html+='<option value="2">Estrato 2</option>';
            html+='<option value="3">Estrato 3</option>';
            html+='<option value="4">Estrato 4</option>';
            html+='<option value="5">Estrato 5</option>';
            html+='<option value="6">Estrato 6</option>';
            html+='</select>';         
            break;
        case '3':
            html='<select id="dato" name="dato" class="span3">';
            html+='<option value="M">Masculino</option>';
            html+='<option value="F">Femenino</option>';
            html+='</select>';
            break;         
        case '4':
            html='<select  id="dato" name="dato" class="span3" onchange="javascript:sel_municipio()">';
            html+='<option value="" selected>Seleccione Municipio</option>';
                $.ajax({
                        url:'<?=site_url();?>/consulta/co_municipios',
                        type:'POST',
                        async:false,
                        success:function(respuesta){
                            var registros = eval(respuesta);                 
                            for (i=0; i<registros.length; i++) { 
                                html+='<option value="'+registros[i]["codigo"]+'">'+registros[i]["nombre"]+'</option>';
                            }               
                        }                   
                });                                        
            html+='</select>';
            break;
        case '5':
            html='<select  id="dato" name="dato" class="span3">';
            html+='<option value="" selected>Seleccione Barrio</option>';
            var mun=document.getElementById("muni").value;
            if(!mun){alert("Debe Asignar Municipio!");}
            else {  
                $.ajax({
                        url:'<?=site_url();?>/consulta/co_barrios',
                        data:{mun:mun},
                        type:'POST',
                        async:false,
                        success:function(respuesta){
                            var registros = eval(respuesta);                 
                            for (i=0; i<registros.length; i++) { 
                                html+='<option value="'+registros[i]["id"]+'">'+registros[i]["nombre"]+'</option>';
                            }               
                        }                   
                }); 
             }                                          
            html+='</select>';        
            break;
        case '6':
            html='<select  id="dato" name="dato" class="span3">';
            html+='<option value="" selected>Seleccione Funcionario</option>';
                $.ajax({
                        url:'<?=site_url();?>/consulta/co_usuarios',
                        type:'POST',
                        async:false,
                        success:function(respuesta){
                            var registros = eval(respuesta);                
                            for (i=0; i<registros.length; i++) { 
                                html+='<option value="'+registros[i]["documento"]+'">'+registros[i]["nombre"]+'</option>';
                            }               
                        }                   
                });                                          
            html+='</select>';  
        break;
        case '7':break;
    }
    $("#cambia_dato").html(html);
}
function sel_municipio(){
    var combo      = document.getElementById("dato");
    var opcion     = combo.options[combo.selectedIndex].value;     
    document.getElementById("muni").value=opcion;    
}
</script>
