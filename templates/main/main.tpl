{extends file="../index.tpl"}
{block name="content"}
<div class="bg-image1 clearfix hidden-xs">
    {include file="./booking.tpl"}
</div>
<div class="main-services-content">
    <div class="container">
        {include file="./services.tpl"}
    </div>
</div>
<div class="container">
    {include file="./content.tpl"}
</div>
{/block}