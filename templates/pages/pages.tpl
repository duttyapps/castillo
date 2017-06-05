{extends file="../index.tpl"}
{block name="content"}
    <div class="container wrap">
        <div class="page-header">
            <h2>{$paginas['NOMBRE']}</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {$paginas['CONTENIDO']}
            </div>
        </div>
    </div>
{/block}