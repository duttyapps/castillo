{extends file="../index.tpl"}
{block name="content"}
    <div class="container wrap">
        <div class="page-header">
            <h2>{$servicios['TITULO']}</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {$servicios['CONTENIDO']}
            </div>
        </div>
    </div>
{/block}