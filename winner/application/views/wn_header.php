<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span><span class="icon-bar"></span>
            <span class="icon-bar"></span> </a><a class="brand" href="">Winner - Olimpica Stereo </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Settings</a></li>
              <li><a href="javascript:;">Help</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container" id="menu">
      <ul class="mainnav">
        <li class="active"><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/personas')">
                <i class="icon-user"></i><span>Personas</span> </a> </li>
        <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/concursos')">
                <i class="icon-list-alt"></i><span>Concursos</span> </a> </li>
        <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/ganadores')">
                <i class="icon-trophy"></i><span>Ganadores</span></a></li>
        <li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/usuario')">
                <i class="icon-cogs"></i><span>Usuario</span> </a> </li>
        <li></li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
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
 //<li><a href="#" onclick="intext('#contenido','<?=site_url()?>/principal/ordenes_asig')">Seguimiento Orden</a></li>    
</script>