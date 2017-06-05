{extends file="../index.tpl"}
{block name="content"}
<div class="container wrap">
    <div class="page-header">
        <h2>Noticias</h2>
    </div>
    <div class="row">
        {if !empty($noticias)}
            {foreach from=$noticias item=entry}
                <div class="col-lg-{$tamano_col} newscontainer">
                    <div class="newstitle">
                        <a href="{$path}/index.php/news/view/{$entry.ulink}">{$entry.titulo}</a>
                    </div>
                    <div class="newscontent">
                        {if !empty($tamano_contenido)}
                            {$entry.contenido|truncate:$tamano_contenido:$delimitador:$truncar}
                        {else}
                            {$entry.contenido}
                        {/if}
                    </div>
                    <div class="newsdate">
                        Publicado el {$entry.fecha}
                    </div>
                </div>
            {/foreach}
        {else}
            La noticia no existe.
        {/if}
    </div>
    {if $ver eq true}
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{$path}/index.php/news">Volver</a>
                </div>
            </div>
        </div>
    {else}
        {if $paginas > 1}
        <div class="container">
            <div class="row">
                <nav aria-label="...">
                    <ul class="pagination">
                        {if $curr_pagina eq 1}
                            <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                        {else}
                            <li><a href="{$path}/index.php/news/page/{$curr_pagina-1}" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                        {/if}
                        {for $i=1 to $paginas}
                            {if $curr_pagina eq $i}
                                <li class="active"><a href="{$path}/index.php/news/page/{$i}">{$i} <span class="sr-only">(current)</span></a></li>
                            {else}
                                <li><a href="{$path}/index.php/news/page/{$i}">{$i}</a></li>
                            {/if}
                        {/for}
                        {if ($curr_pagina+1) > $paginas}
                            <li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                        {else}
                            <li><a href="{$path}/index.php/news/page/{$curr_pagina+1}" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                        {/if}
                    </ul>
                </nav>
            </div>
        </div>
        {/if}
    {/if}
</div>
{/block}