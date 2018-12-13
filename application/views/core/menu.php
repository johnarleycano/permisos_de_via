<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-center">
        <div class="uk-navbar-center-left">
            <div>
                <ul class="uk-navbar-nav">
                    <li class="uk-active"><a href="<?php echo site_url('solicitud'); ?>">Nueva solicitud</a></li>
                    <li>
                        <a href="<?php echo site_url('solicitud/ver'); ?>">Histórico</a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><a href="<?php echo site_url('solicitud/ver'); ?>">Ver</a></li>
                                <!-- <li><a href="#">Seguimientos</a></li> -->
                                <!-- <li><a href="#">Bitácora</a></li> -->
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <a class="uk-navbar-item uk-logo" href="<?php echo site_url(''); ?>"><img src="<?php echo base_url().'img/logo.png'; ?>" alt="Devimed S.A." width="100"></a>
        <div class="uk-navbar-center-right">
            <div>
                <ul class="uk-navbar-nav">
                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="<?php echo site_url('normatividad/ver'); ?>">Normatividad</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-active"><a href="<?php echo site_url('normatividad/crear'); ?>">Crear</a></li>
                                    <li class="uk-active"><a href="<?php echo site_url('normatividad/ver'); ?>">Ver</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <li><a href="<?php echo site_url('sesion/cerrar'); ?>">Salir</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>