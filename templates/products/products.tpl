{extends file="../index.tpl"}
{block name="content"}
{if empty($action)}
    {include file="./action/main.tpl"}
{/if}
{if $action eq "view"}
    {include file="./action/view.tpl"}
{/if}
{/block}