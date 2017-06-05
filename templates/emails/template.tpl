<html lang="es">
<head>
    <style>
        .mail-table {
            width: 90%;
            border: 1px solid #2d313e;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #111;
        }

        .mail-header>td {
            padding: 10px;
            background-color: #2d313e;
        }

        .mail-footer>td {
            padding: 20px 10px;
            background-color: #2d313e;
            font-size: 12px;
            text-align: center;
            color: #c0c0c0;
        }

        .mail-body>td {
            padding: 20px 10px;
        }
    </style>
</head>
<body>
<table class="mail-table" cellpadding="0" cellspacing="0" align="center">
    <tr class="mail-header">
        <td>
            <img src="{$url_logo}" alt="">
        </td>
    </tr>
    <tr class="mail-body">
        <td>
            {block name="content"}{/block}
        </td>
    </tr>
    <tr class="mail-footer">
        <td>
            Castillo de Chancay 2017
        </td>
    </tr>
</table>
</body>
</html>