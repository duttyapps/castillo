{extends file="../index.tpl"}
{block name="content"}
    <div class="container wrap">
        <div class="page-header">
            <h2>{$promociones['NOMBRE']}</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="promo-img">
                    <img src="{$path}/images/promociones/{$promociones['ID']}.jpg" alt="{$promociones['NOMBRE']}" class="img-responsive">
                </div>
                {$promociones['DESCRIPCION']}
            </div>
        </div>
    </div>
{/block}