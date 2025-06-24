 <div id="background-loading">
 <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
 </div>
<body class="fixed-left" onload="javascript:inicio();">         
        <!-- Begin page -->
        <div id="wrapper">        
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="javascript:menu();" class="logo"><img src='<?= base_url() ?>img/it.png' width='26' height='26'><span>&nbsp;IntegraTIC</span></a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="fa fa-bars"></i>
                                </button>                            
                            </div>
                            
                            <form class="navbar-form pull-left text-white" role="search">
                                <div class="form-group">
                                    <!--<input type="text" class="form-control search-bar" placeholder="Buscar...">-->
                                </div>
                                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                            </form>                          
                            <div><input type="hidden" id="cod" name="cod" value="0"/></div>
                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">                                    
                                    <a href="javascript:void(0);" class="logo"><div id="nomusuario">
                                        <span><?= ($this->session->userdata('logged_in')) ? "Hola, " . $this->session->userdata("logged_in")["nombres"] : ""?>
                                        </span></div></a>  
                                       <?php
                                          if(($this->session->userdata('logged_in'))){
                                             ?>
                                                <form>
                                                   <input type="hidden" id="ced" name="ced" value='<?= $this->session->userdata("logged_in")["id"] ?>'>
                                                   <input class="form-control input-sm" type="hidden" id="usr_cambio" name="usr_cambio" value="<?= $this->session->userdata("logged_in")["usuario"] ?>">
                                                   <input type="hidden" id="rol" name="rol" value="<?= $this->session->userdata("logged_in")["rol"] ?>">
                                                </form>
                                             <?php
                                          }
                                       ?>                                  
                                </li>
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light notificaciones-icon" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-bell"></i>
                                        <div class="counter-notification">
                                           <p id="contador-notificaciones"><?= obtener_contador_anuncios() ?></p>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notificaciones</li>
                                        <div id="notificaciones-container">
                                           
                                        </div>
                                    </ul>
                                </li>
                                <?php
                                       if(is_logged() && strtolower(logged_user()["rol"]) == "docente"){
                                          ?>
                                          <li>
                                             <a href="<?= base_url() ?>Caracterizacion" class=" waves-effect waves-light" aria-expanded="true">
                                                <i class="fa fa-search"></i>
                                             </a>
                                          </li>
                                          <?php
                                       }
                                    ?>
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-th"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Filtrar áreas</li>
                                        <li class="list-group">
                                           <a href="javascript:filtrar_menu('MATEMATICAS');" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Matemáticas</div>
                                                 </div>
                                              </div>
                                           </a>           
                                            <a href="javascript:filtrar_menu('NATURALES');" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Ciencias Naturales</div>
                                                 </div>
                                              </div>
                                            </a>
                                            <a href="javascript:filtrar_menu('SOCIALES');" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Ciencias Sociales</div>
                                                 </div>
                                              </div>
                                            </a>
                                            <!-- list item-->
                                            <a href="javascript:filtrar_menu('TECNOLOGIA');" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Tecnología e Informática</div>
                                                 </div>
                                              </div>
                                            </a>                                           
                                            <a href="javascript:filtrar_menu('LENGUAJE');" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Lenguaje</div>
                                                 </div>
                                              </div>
                                            </a>                     
                                            <a href="javascript:filtrar_menu('IDIOMAS');" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Idiomas</div>
                                                 </div>
                                              </div>
                                            </a>      
                                            <a href="javascript:filtrar_menu('ARTISTICA');" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Educación Artística</div>
                                                 </div>
                                              </div>
                                            </a>
                                            <a href="javascript:filtrar_menu('RELIGIOSA');" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Educación Religiosa</div>
                                                 </div>
                                              </div>
                                            </a>                                                                        
                                            <a href="javascript:filtrar_menu('PLATAFORMA');" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Plataformas</div>
                                                 </div>
                                              </div>
                                            </a>  
                                            <a href="javascript:filtrar_menu('VIDEOS');" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Videos</div>
                                                 </div>
                                              </div>
                                            </a>   
                                        </li>
                                    </ul>
                                </li>
                                <?php
                                    /*if(is_logged()){
                                       if(strtolower(logged_user()["rol"]) == "estudiante"){
                                          ?>
                                          <li class="dropdown">
                                             <a class="dropdown-toggle profile">
                                                <h4 id="logged_user_grade"><?= logged_user()["grado"].logged_user()["grupo"] ?></h4>
                                             </a>
                                          </li>
                                          <?php
                                       }
                                    }*/
                                ?>
                                <!--<li class="dropdown"><div id="foto"><br>                                    
                                    <a href="javascript:prelogin();" class="dropdown-toggle profile"><img src="./images/user.png" alt="user-img" class="img-circle"></a>
                                    </div>
                                </li>-->
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
           </div>
            <!-- Top Bar End -->
            <script>
               let base_url = "<?= base_url() ?>";
               let configuracion = JSON.parse('<?= json_encode(configuracion()) ?>');
            </script>
