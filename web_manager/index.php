<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel - Castillo de Chancay</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .form-signin{
            max-width: 420px;
            padding: 30px 38px 66px;
            border: 1px solid #cccccc;
        }
        .input-group{
            height: 45px;
            margin-bottom: 15px;
            border-radius: 0px;
            color: #B11F28;
        }
        .form-control{
            height: 45px;
            color: #B11F28;
        }
        .input-group:hover span i{
            color: #B11F28;
        }
        .btn-block{
            border-radius: 0px;
            margin-top: 25px;
            background-color: #B11F28;
            border: none;
        }
        .btn-block:hover{
            background-color: red;
        }
        .bol{
            position: relative;
            margin-top: -40px;
            color: #B11F28;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <form action="login.php" method="post" name="Login_Form" class="form-signin">
                <input type="hidden" name="action" value="login">
                <div class="row text-center bol"><i class="fa fa-circle"></i></div>
                <h3 class="form-signin-heading text-center">
                    <img src="../images/logo.png" alt=""/>
                </h3>
                <hr class="spartan">
                <div id="message"></div>
                <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon1">
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                    <input type="text" class="form-control" name="user" placeholder="Username" required="" autofocus="" />
                </div>
                <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon1">
                            <i class="glyphicon glyphicon-lock"></i>
                        </span>
                    <input type="password" class="form-control" name="pass" placeholder="Password" required=""/>
                </div>
                <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Entrar" type="Submit">Entrar</button>
            </form>
        </div>
    </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>