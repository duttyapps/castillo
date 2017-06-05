<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{$title}Castillo de Chancay</title>
        <link href="{$path}/css/bootstrap.min.css" rel="stylesheet">
        <link href="{$path}/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="{$path}/css/custom.css" rel="stylesheet">
        {$module_css}
        <link href="{$path}/css/animate.css" rel="stylesheet">
        <link href="{$path}/css/hover-min.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="{$path}/js/bootstrap.min.js"></script>
        <script src="{$path}/js/all.js"></script>
        <script src="{$path}/js/wow.min.js"></script>
        <script src="{$path}/js/moment.min.js"></script>
        <script src="{$path}/js/moment-with-locales.min.js"></script>
        <script src="{$path}/js/bootstrap-datetimepicker.min.js"></script>
        {$module_js}
        <script>
            new WOW().init();
            $contextPath = '{$path}';
        </script>
    </head>
    <body>
    {include file="./navbar.tpl"}