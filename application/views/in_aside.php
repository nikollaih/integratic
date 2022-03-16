<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                <img src="./img/logo.png" alt="" class="thumb-lg">
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="javascript:menu();" class="waves-effect active">
                        <i><img src='./img/iconos/aplicativos.png' width="50" height="50"></i><span>Aplicativos</span></a>
                </li>                         
                <li>
                    <a href="./principal/aprender" target='_blank'>
                        <i><img src='./img/iconos/aprender.png' width="50" height="50"></i><span>Aprender</span></a>
                </li>
                <!-- <li>
                    <a href="javascript:areas();" class="waves-effect">
                        <i><img src='./img/iconos/areas.png' width="50" height="50"></i><span>Areas</span></a>
                </li> -->
                <li>
                    <a href="javascript:subir_acti();" class="waves-effect">
                        <i><img src='./img/iconos/cargar.png' width="50" height="50"></i><span>Subir<br>Actividades</span></a>
                </li>               
                <li>
                    <a href="../moodle" class="waves-effect" target='_blank'>
                        <i><img src='./img/iconos/moodle.png' width="50" height="50"></i><span> Moodle </span></a>
                </li>
                <!--<li>
                    <a href="./principal/project" class="waves-effect" target='_blank'>
                        <i><img src='./img/iconos/claseweb.ico' width="50" height="50"></i><span>ClaseWeb</span></a>
                </li>-->  
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End --> 
<script>
    function intext(div,op){
        $.ajax({
              type: "POST",
              url: op,
              success: function(a) {
                  $(div).html('');
                  $(div).html(a);
              }
         });   
    }      
</script>