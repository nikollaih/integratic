<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->    
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row" id="migas">
                <div class="col-sm-12">
                    <div id="marco">
                        <h4 class="pull-left page-title">Bienvenido!</h4>
                    </div>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Intranet</a></li>
                        <li class="active">Principal</li>
                    </ol>
                </div>
            </div>
            <div id="contenedor">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <a href="javascript:aprender()"><img src="<?=base_url()?>img/botones/aprender.png" width="100%" height="100%"></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <a href="javascript:areas()"><img src="<?=base_url()?>img/botones/areas.png"  width="100%" height="100%"></a>
                    </div>
                </div>     
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="javascript:aprender()"><img src="<?=base_url()?>img/botones/moodlegs.png"  width="100%" height="100%"></a>
                    </div>
                </div>      
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="<?=base_url()?>principal/project" target='_blank'><img src="<?=base_url()?>img/botones/claseweb.png"  width="100%" height="100%"></a>
                    </div>
                </div>     
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="javascript:aprender()"><img src="<?=base_url()?>img/botones/cpe.png"  width="100%" height="100%"></a>
                    </div>
                </div> 
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="javascript:listado('raiz','dpensar','dpensar')"><img src="<?=base_url()?>img/botones/dpensar.png"  width="100%" height="100%"></a>
                    </div>
                </div>  
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="<?=base_url()?>principal/fisica" target='_blank'><img src="<?=base_url()?>img/botones/fisicaor.png"  width="100%" height="100%"></a>
                    </div>
                </div>  
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="javascript:listado('raiz','semilla','semilla')"><img src="<?=base_url()?>img/botones/semilla.png"  width="100%" height="100%"></a>
                    </div>
                </div> 
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="javascript:listado('raiz','plugins','plugins')"><img src="<?=base_url()?>img/botones/plugins.png"  width="100%" height="100%"></a>
                    </div>
                </div> 
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="javascript:lab()"><img src="<?=base_url()?>img/botones/virtualab.png"  width="100%" height="100%"></a>
                    </div>
                </div>  
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href='javascript:listado("raiz","animaingles","animaingles");'><img src="<?=base_url()?>img/botones/animaciones.png"  width="100%" height="100%"></a>
                    </div>
                </div>     
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="javascript:listado('raiz','bibliotecags','bibliotecags')">
                           <img src="<?=base_url()?>img/botones/biblioteca.png"  width="100%" height="100%"></a>
                    </div>
                </div> 
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <a href="<?=base_url()?>principal/cidead/edad" target='_blank'>
                           <img src="<?=base_url()?>img/botones/cidead.png"  width="100%" height="100%"></a>
                    </div>
                </div> 
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="javascript:listado('raiz','mecanico','mecanico')">
                           <img src="<?=base_url()?>img/botones/universo.png"  width="100%" height="100%"></a>
                    </div>
                </div>                
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                       <a href="javascript:listado('raiz','saber','saber')"><img src="<?=base_url()?>img/botones/saber.png"  width="100%" height="100%"></a>
                    </div>
                </div>                 
            </div>
        </div> <!-- container -->                               
    </div> <!-- content -->
</div></div>
<!-- Ventana Modal Asignar-->
<div class="modal fade" id="portada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">
                <img src="<?=base_url()?>img/portada.png"  width="100%" height="100%">
      </div>
    </div>
  </div>
</div> 
<!-- Fin Modal -->
<script>
function inicio(){$('#portada').modal('hide'); }

function matematicas(){
    html="<div class='row'>";
    html+="<div class='col-md-6  col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"matematicas1"'+");'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/matematicas1.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"matematicas2"'+");'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/matematicas2.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"matematicas3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/matematicas3.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"matematicas4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/matematicas4.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"matematicas5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/matematicas5.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"matematicas6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/matematicas6.jpg' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"matematicas7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/matematicas7.jpg' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"matematicas8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/matematicas8.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"matematicas9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/matematicas9.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";   
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"trigonometria10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/trigonometria10.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"calculo11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/calculo11.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>"; 
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"estadistica10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/estadistica10.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"estadistica11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/estadistica11.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";        
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"geometria4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/geometria4.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"geometria5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/geometria5.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"geometria6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/geometria6.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"geometria7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/geometria7.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"geometria8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/geometria8.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"matematicas"'+","+'"geometria9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/geometria9.png' width='100%' height='100%'></a></div></div>";      
    html+="</div>";    
    $("#contenedor").html(html);
}
function naturales(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"naturales1"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/naturales1.jpg' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"naturales2"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/naturales2.jpg' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"naturales3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/naturales3.jpg' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"naturales4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/naturales4.jpg' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"areas"'+","+'"naturales"'+","+'"naturales5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/naturales5.jpg' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"naturales6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/naturales6.jpg' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"naturales7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/naturales7.jpg' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"naturales8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/naturales8.jpg' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"naturales9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/naturales9.jpg' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"fisica10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/fisica10.jpg' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"fisica11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/fisica11.jpg' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"quimica10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/quimica10.jpg' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"naturales"'+","+'"quimica11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/quimica11.jpg' width='100%' height='100%'></a></div></div>";      
    html+="</div>";    
    $("#contenedor").html(html);
}
function sociales(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"historia1"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/historia1.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"historia2"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/historia2.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"historia3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/historia3.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"historia4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/historia4.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"historia6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/historia6.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"historia7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/historia7.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"historia8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/historia8.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"historia9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/historia9.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"historia10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/historia10.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"historia11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/historia11.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"paz4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/paz4.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"paz5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/paz5.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"paz6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/paz6.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"paz7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/paz7.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"paz8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/paz8.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"paz9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/paz9.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"paz10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/paz10.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"paz11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/paz11.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"pcc6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/pcc6.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"pcc7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/pcc7.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"pcc8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/pcc8.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"pcc9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/pcc9.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"pcc10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/pcc10.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"sociales"'+","+'"pcc11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/pcc11.png' width='100%' height='100%'></a></div></div>";     
    html+="</div>";    
    $("#contenedor").html(html);
}
function filosofia(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"filosofia"'+","+'"filosofia9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/filosofia/filosofia9.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"filosofia"'+","+'"filosofia10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/filosofia/filosofia10.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"filosofia"'+","+'"filosofia11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/filosofia/filosofia11.png' width='100%' height='100%'></a></div></div>";        
    html+="</div>";    
    $("#contenedor").html(html);
}
function humanidades(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana1"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana1.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana2"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana2.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana3.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana4.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana5.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana6.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana7.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana8.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana9.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana10.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"castellana11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/castellana11.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles1"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles1.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles2"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles2.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles3.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles4.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles5.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles6.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles7.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles8.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles9.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles10.png' width='100%' height='100%'></a></div></div>";     
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"ingles11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/ingles11.png' width='100%' height='100%'></a></div></div>";                 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"critica4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/critica4.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"critica5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/critica5.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"critica6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/critica6.png' width='100%' height='100%'></a></div></div>";     
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"critica7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/critica7.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"critica8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/critica8.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"lecto1"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/lecto2.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"lecto2"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/lecto2.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"humanidades"'+","+'"lecto3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/lecto3.png' width='100%' height='100%'></a></div></div>";     
    html+="</div>";    
    $("#contenedor").html(html);
}
function tecnologia(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia1"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia1.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia2"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia2.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia3.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia4.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia5.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia6.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"informatica6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/informatica6.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia7.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"informatica7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/informatica7.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia8.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"informatica8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/informatica8.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia9.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia10.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"tecnologia"'+","+'"tecnologia11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia11.png' width='100%' height='100%'></a></div></div>";    
    html+="</div>";    
    $("#contenedor").html(html);
}
function ciudadanas(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas1"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas1.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas2"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas2.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas3.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas4.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas5.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas6.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas7.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas8.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas9.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas10.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"ciudadanas"'+","+'"ciudadanas11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas11.png' width='100%' height='100%'></a></div></div>";      
    html+="</div>";    
    $("#contenedor").html(html);
}
function etica(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"etica1"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica1.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"etica2"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica2.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"etica3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica3.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"eticas4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica4.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"etica5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica5.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"etica6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica6.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"etica7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica7.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"etica8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica8.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"etica9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica9.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"etica10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica10.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"etica"'+","+'"etica11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica11.png' width='100%' height='100%'></a></div></div>";      
    html+="</div>";    
    $("#contenedor").html(html);
}
function religion(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion1"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion1.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion2"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion2.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion3.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion4.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion5.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion6.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion7.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion8.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion9.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion10.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"religion"'+","+'"religion11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion11.png' width='100%' height='100%'></a></div></div>";      
    html+="</div>";    
    $("#contenedor").html(html);
}
function edfisica(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica1"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica1.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica2"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica2.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica3"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica3.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica4"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica4.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica5"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica5.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica6"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica6.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica7"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica7.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica8"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica8.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica9"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica9.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica10"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica10.png' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areas"'+","+'"edfisica"'+","+'"edfisica11"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica11.png' width='100%' height='100%'></a></div></div>";      
    html+="</div>";    
    $("#contenedor").html(html);
}

function areas(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areabase"'+","+'"preescolar"'+","+'"preescolar"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/preescolar/preescolar.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:matematicas()'>";
    html+="<img src='<?=base_url()?>img/botones/matematicas/matematicas.jpg' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:naturales()'>";
    html+="<img src='<?=base_url()?>img/botones/naturales/naturales.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:sociales()'>";
    html+="<img src='<?=base_url()?>img/botones/sociales/sociales.jpg' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:filosofia()'>";
    html+="<img src='<?=base_url()?>img/botones/filosofia/filosofia.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:humanidades()'>";
    html+="<img src='<?=base_url()?>img/botones/humanidades/humanidades.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:tecnologia()'>";
    html+="<img src='<?=base_url()?>img/botones/tecnologia/tecnologia.jpg' width='100%' height='100%'></a></div></div>"; 
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areabase"'+","+'"economicas"'+","+'"economicas"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/economicas/economicas.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:ciudadanas()'>";
    html+="<img src='<?=base_url()?>img/botones/ciudadanas/ciudadanas.png' width='100%' height='100%'></a></div></div>";  
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:etica()'>";
    html+="<img src='<?=base_url()?>img/botones/etica/etica.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"areabase"'+","+'"politicas"'+","+'"politicas"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/politicas/politicas.png' width='100%' height='100%'></a></div></div>";      
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:religion()'>";
    html+="<img src='<?=base_url()?>img/botones/religion/religion.png' width='100%' height='100%'></a></div></div>";   
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:edfisica()'>";
    html+="<img src='<?=base_url()?>img/botones/edfisica/edfisica.png' width='100%' height='100%'></a></div></div>";    
    html+="</div>";    
    $("#contenedor").html(html);
}
function lab(){
    html="<div class='row'>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"labs"'+","+'"labs"'+","+'"biologia"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/lab/biolab.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";    
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"labs"'+","+'"labs"'+","+'"fisica"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/lab/fislab.png' width='100%' height='100%'></a></div></div>";    
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"labs"'+","+'"labs"'+","+'"matematicas"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/lab/matlab.png' width='100%' height='100%'></a></div></div>";
    html+="<div class='col-md-6 col-sm-6 col-lg-3'>";
    html+="<div class='mini-stat clearfix bx-shadow'><a href='javascript:listado("+'"labs"'+","+'"labs"'+","+'"quimica"'+")'>";
    html+="<img src='<?=base_url()?>img/botones/lab/quimlab.png' width='100%' height='100%'></a></div></div>";      
    html+="</div>";    
    $("#contenedor").html(html);
}
function listado(tipo,carpeta,materia){
    switch(tipo){
        case 'labs':titulo = "<h4 class='pull-left page-title'>Laboratoria Virtual "+materia+"</h4>";
            break;
        case 'biblioteca':titulo = "<h4 class='pull-left page-title'>Biblioteca Virtual GS</h4>";  
            break;
        case 'saber':titulo = "<h4 class='pull-left page-title'>Pruebas y Simulacros Saber</h4>";  
            break;       
        case 'semilla':titulo = "<h4 class='pull-left page-title'>Colección Semilla</h4>";  
            break;    
        case 'areas':
                var gra=materia.replace(/\D/g,'');
                var mat=materia.replace(gra,'');            
                titulo = "<h4 class='pull-left page-title'>"+mat+" grado "+gra+"o.</h4>";  
            break;             
    } 
     
    url='<?=site_url();?>/principal/listar/'+tipo+'/'+carpeta+'/'+materia;
            $.ajax({
               url:url,
               type:'POST',
               success:function(respuesta){ 
                        $("#marco").html(titulo);
                        $("#contenedor").html(respuesta);              
               },
               error:function(){alert("Ocurrió un Error!");}        
       });          
}

function prelogin(){
    titulo = "<h4>Ingreso a Docentes</h4>";
    html="<div class='wrapper-page'>";
    html=html+"<div class='panel panel-color panel-primary panel-pages'>";
    html=html+"<div class='panel-heading bg-img'>";
    html=html+"<div class='bg-overlay'></div>";
    html=html+"<h3 class='text-center m-t-10 text-white'><strong>Intranet</strong> </h3></div>";
    html=html+"<div class='panel-body'>";
    html=html+"<form id='frmlogin' class='form-horizontal m-t-20'>";                    
    html=html+"<div class='form-group '>";
    html=html+"<div class='col-xs-12'>";
    html=html+"<input id='usr' name='usr'  class='form-control input-lg' required placeholder='Usuario' type='text'>";
    html=html+"</div> </div>";
    html=html+"<div class='form-group'>";
    html=html+"<div class='col-xs-12'>";
    html=html+"<input id='pass' name='pass' class='form-control input-lg' required placeholder='Contraseña' type='password'>";
    html=html+"</div></div>";
    html=html+"<div class='form-group '>";               
    html=html+"<div class='form-group text-center m-t-40'>";
    html=html+"<div class='col-xs-12'>";
    html=html+"<button type='button' class='btn btn-success btn-lg w-lg waves-effect waves-light' onclick='login();'>Ingresar</button>";
    html=html+"</div></div></form></div></div></div>";  
                        $("#marco").html(titulo);
                        $("#migas").html("");
                        $("#contenedor").html(html);              
}
function login(){
    var url = "<?=site_url()?>/docente/login";  
    alert($("#frmlogin").serialize());
        $.ajax({
               url:url,
               type:'POST',
               data:$("#frmlogin").serialize(),
               success:function(respuesta){ 
                alert(respuesta);
                $("#contenedor").html(respuesta);    
                },
               error:function(){ alert("Error!");}                                   
               });
}
function listar_materias(id){
    $("#avance").modal("hide");
    var url = "<?=site_url()?>/docente/asg_materias";  
        $.ajax({
               url:url,
               type:'POST',
               data:$("#frmlogin").serialize(),
               success:function(respuesta){ 
                 var registros = eval(respuesta);
                 alert(respuesta);
                      if(registros.length>0){ 
                          for (i=0; i<registros.length; i++) {   
                                    $("#marco").html('Hola, '+registros[i]["nombres"]);
                                    listar_materias(registros[i]["id"]);
                                }          
                      }
                $("#contenedor").html('');    
                },
               error:function(){ alert("Usuario o Contraseña Invalidos!");}                                   
               });
}
</script>