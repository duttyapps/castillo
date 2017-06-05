        <div class="container-body">
            {if $module!="main"}
            <div id="header_shop">
                <div class="container">
                    <div class="row row-eq-height">
                        <div class="col-lg-3">
                            <a href="{$path}/">
                                <img src="{$path}/images/logo.png" style="vertical-align: text-top;">
                            </a>
                        </div>
                        <div class="col-lg-5">
                            <form action="{$path}/search" method="get">
                                <div id="prod-form">
                                    <div id="prod-form-text">
                                        <input type="text" name="q" autocomplete="off" placeholder="Buscar">
                                    </div>
                                    <div class="icon-search">
                                        <img src="{$path}/images/search.png" alt="" width="22">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2">
                            <div id="prod-login">
                                Bienvenid@<br>
                                <a href="{$path}/login">Acceder</a> ó <a href="{$path}/register">Registrarse</a>
                            </div>
                        </div>
                        <div class="col-lg-2" style="border-left: 2px solid #f5f5f5;">
                            <div id="cart" div-href="{$path}/cart">
                                <div id="cart-img"><img src="{$path}/images/cart.png" alt=""></div>
                                <div id="cart-spn">Carrito de<br>Compras</div>
                                <div id="cart-qty">0</div>
                            </div>
                            <div id="cart-details">
                                <div class="top-close">
                                    <button type="button" id="btnCloseCartDet" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="cart-det-title" div-href="{$path}/cart">
                                    <img src="{$path}/images/cart.png" width="32"> <span class="valign-middle">Resumen del Carrito</span>
                                </div>
                                <hr>
                                <div id="cart-det-list"></div>
                                <div id="cart-det-qty">Tienes en total <span id="qty-prod">0</span> productos</div>
                                <div id="cart-det-total">Subtotal <span id="subtotal">S/ 0.00</span></div>
                                <div id="cart-det-button" class="text-right">
                                    <button>Pagar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {/if}
            <nav class="navbar nicenavbar{if $module!="main"} nicenavbar-black{/if}">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-options" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        {if $module!="main"}
                        <!--a href="{$path}/">
                            <img src="{$path}/images/logow.png" style="vertical-align: text-top;">
                        </a-->
                        {/if}
                    </div>

                    <div class="collapse navbar-collapse" id="nav-options">
                        <ul class="nav navbar-nav{if $module=="main"} navbar-right{else} navbar-center{/if}">
                            <li><a href="{$path}/"><span class="material-icons icon hidden-xs">home</span>Inicio</a></li>
                            <!--li><a href="#"><span class="material-icons icon hidden-xs">local_see</span>Galeria</a></li-->
                            <li><a href="{$path}/"><span class="material-icons icon hidden-xs">local_offer</span>Servicios</a></li>
                            <li><a href="{$path}/"><span class="material-icons icon hidden-xs">hotel</span>Reservas</a></li>
                            <li><a href="{$path}/products"><span class="material-icons icon hidden-xs">shopping_cart</span>Tienda</a></li>
                            <li><a href="{$path}/contact"><span class="material-icons icon hidden-xs">email</span>Contacto</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            {if $module!="main"}
            <div class="clearfix"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6"></div>
                </div>
            </div>
            {/if}
        </div>