<?php
include 'login.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel - Castillo de Chancay</title>

    <!-- Bootstrap -->
    <link href="assets/css/entypo.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-table.css" rel="stylesheet">
    <link href="assets/ext/summernote/summernote.css" rel="stylesheet">
    <link href="assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/css/global.css" rel="stylesheet">
    <link href="assets/css/forms.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
    <div class="page-container">
        <div class="page-sidebar">
            <header class="site-header">
                <div class="site-logo"><a href="panel.php"><img src="../images/logow.png"></a></div>
                <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
                <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
            </header>
            <ul id="side-nav" class="main-menu navbar-collapse collapse">
                <li class="has-sub"><a href="#"><i class="fa fa-cogs"></i><span class="title">General</span></a>
                    <ul class="nav collapse">
                        <li><a href="panel.php?do=paginas"><span class="title">Páginas</span></a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href="#"><i class="fa fa-hotel"></i><span class="title">Hoteles</span></a>
                    <ul class="nav collapse">
                        <li><a href="panel.php?do=hoteles"><span class="title">Administrar Hoteles</span></a></li>
                        <li><a href="panel.php?do=reservas"><span class="title">Reservas</span></a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href="#"><i class="fa fa-hotel"></i><span class="title">Servicios</span></a>
                    <ul class="nav collapse">
                        <li><a href="panel.php?do=servicios"><span class="title">Administrar Servicios</span></a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href="#"><i class="fa fa-heart"></i><span class="title">Promociones</span></a>
                    <ul class="nav collapse">
                        <li><a href="panel.php?do=promociones"><span class="title">Administrar Promociones</span></a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href="#"><i class="fa fa-newspaper-o"></i><span class="title">Noticias</span></a>
                    <ul class="nav collapse">
                        <li><a href="panel.php?do=noticias"><span class="title">Administrar Noticias</span></a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i><span class="title">Tienda</span></a>
                    <ul class="nav collapse">
                        <li><a href="panel.php?do=productos"><span class="title">Productos</span></a></li>
                        <li><a href="panel.php?do=categoria_productos"><span class="title">Categorias</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="main-container">
            <div class="main-header row">
                <div class="col-sm-6 col-xs-7">

                    <!-- User info -->
                    <ul class="user-info pull-left">
                        <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> <img width="44" class="img-circle avatar" alt="" src="assets/img/user.png"><?php echo $_SESSION['ADM_NOMBRES']; ?> <span class="caret"></span></a>

                            <!-- User action menu -->
                            <ul class="dropdown-menu">

                                <li><a href="#/"><i class="icon-user"></i>My profile</a></li>
                                <li><a href="#/"><i class="icon-mail"></i>Messages</a></li>
                                <li><a href="#"><i class="icon-clipboard"></i>Tasks</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="icon-cog"></i>Account settings</a></li>
                                <li><a href="#"><i class="icon-logout"></i>Logout</a></li>
                            </ul>
                            <!-- /user action menu -->

                        </li>
                    </ul>
                    <!-- /user info -->

                </div>

                <div class="col-sm-6 col-xs-5">
                    <div class="pull-right">
                    </div>
                </div>
            </div>
            <div class="main-content">
                <?php
                $section = $_GET['do'];
                $mod = $_GET['mod'];
                if(empty($section)) {
                    $section = 'main';
                }
                include "sections/{$section}/index.php";
                ?>
                <!-- Footer -->
                <footer class="footer-main">
                    © <?php echo date('Y'); ?> <strong>NOW</strong> - Agencia Digital
                </footer>
                <!-- /footer -->

            </div>
        </div>
    </div>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!--script src="assets/js/jquery-ui.js"></script-->
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/bootstrap-table.js"></script>
    <script src="assets/js/bootstrap-table-es-ES.min.js" charset="UTF-8"></script>
    <script src="assets/ext/summernote/summernote.min.js"></script>
    <script src="assets/ext/summernote/lang/summernote-es-ES.js" charset="UTF-8"></script>
    <script src="assets/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
    <script src="assets/js/functions.js"></script>
</body>
</html>
