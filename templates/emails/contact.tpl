{extends file="./template.tpl"}
{block name="content"}
<p>Hola, <b>{$nombres}</b> te dejó un mensaje en la web:</p>
<p>{$mensaje}</p>
<br>
<hr>
<p>Datos adicionales:</p>
Nombres: {$nombres}<br>
Email: {$email}<br>
Teléfono: {$telefono}<br>
Pais: {$pais}<br>
Ciudad: {$ciudad}<br>
IP: {$smarty.server.REMOTE_ADDR}
{/block}