{extends file="../index.tpl"}
{block name="content"}
    {if empty($action)}
        {include file="./action/main.tpl"}
    {/if}
    {if $action eq "confirm"}
        {include file="./action/confirm.tpl"}
    {/if}
    {if $action eq "done"}
        {include file="./action/done.tpl"}
    {/if}
{/block}