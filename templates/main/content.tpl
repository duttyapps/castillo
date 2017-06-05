<div class="row">
    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading no-border clearfix">
                <h2 class="panel-title">Promociones</h2>
            </div>
            <div class="panel-body">
                <div class="carousel slide" id="carousel-promo">
                    <div class="carousel-inner" role="listbox">
                        {$number = 0}
                        {foreach from=$promociones item=entry}
                        {if $number eq 0}
                            {$active = "active"}
                        {else}
                            {$active = ""}
                        {/if}
                        <div class="item {$active}">
                            <a href="{$path}/promotions/{$entry.LINK}">
                                <img src="{$path}/images/promociones/{$entry.ID}.jpg" alt="{$entry.NOMBRE}" class="img-responsive">
                            </a>
                        </div>
                        {$number = $number +1}
                        {/foreach}
                    </div>
                </div>
                <div class="carousel-footer">
                    <div class="carousel-controller">
                        <a data-slide="prev" href="#carousel-promo" class="btn-carousel"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a data-slide="next" href="#carousel-promo" class="btn-carousel"><i class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>
                    <strong><a href="{$path}/promotions" class="link uppercase">Motrar Todas las Promociones</a></strong>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="panel panel-default">
            <div class="panel-heading no-border clearfix">
                <h2 class="panel-title">Últimas Noticias</h2>
            </div>
            <div class="panel-body">
                <div class="carousel slide" id="carousel-news">
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <ul class="list-item most-watched">
                            {foreach from=$noticias item=entry}
                                <li>
                                    <div class="lockup-video">
                                        <div class="lockup-thumbnail">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <img src="{$path}/images/noticias/{$entry.ID}.jpg" alt="{$entry.TITULO}" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="lockup-content">
                                            <div class="lockup-title"><a href="#">{$entry.TITULO}</a></div>
                                            <div class="lockup-description">
                                                <p>{$entry.CONTENIDO|truncate:100:"...":false}</p>
                                            </div>
                                            <div class="lockup-meta">
                                                <span>{$entry.FECHA_REG}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            {/foreach}
                            </ul>
                        </div>
                        <div class="item">
                            <ul class="list-item most-watched">
                            {foreach from=$noticias item=entry}
                                    <li>
                                        <div class="lockup-video">
                                            <div class="lockup-thumbnail">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <img src="{$path}/images/noticias/{$entry.ID}.jpg" alt="{$entry.TITULO}" class="img-responsive">
                                                </div>
                                            </div>
                                            <div class="lockup-content">
                                                <div class="lockup-title"><a href="{$path}/news/{$entry.LINK}">{$entry.TITULO}</a></div>
                                                <div class="lockup-description">
                                                    <p>{$entry.CONTENIDO|truncate:100:"...":false}</p>
                                                </div>
                                                <div class="lockup-meta">
                                                    <span>{$entry.FECHA_REG}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                            {/foreach}
                            </ul>
                        </div>
                    </div>
                    <div class="carousel-footer">
                        <div class="carousel-controller">
                            <a data-slide="prev" href="#carousel-news" class="btn-carousel"><i class="glyphicon glyphicon-chevron-left"></i></a>
                            <a data-slide="next" href="#carousel-news" class="btn-carousel"><i class="glyphicon glyphicon-chevron-right"></i></a>
                        </div>
                        <strong><a href="{$path}/news" class="link uppercase">Motrar Todas las Noticias</a></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading no-border clearfix">
                <h2 class="panel-title">Productos Recomendados</h2>
            </div>
            <div class="panel-body">
                {foreach from=$productos item=entry}
                    <div class="col-lg-2">
                        <a href="{$path}/products/action/view/{$entry.LINK}">
                            <img src="{$path}/images/products/{$entry.ID}.jpg" class="main-prod-item-img" align="center">
                        </a>
                        <div class="main-prod-item-title"><a href="{$path}/products/action/view/{$entry.LINK}">{$entry.NOMBRE}</a></div>
                        <div class="main-prod-item-price">S/ {$entry.PRECIO|string_format:"%.2f"}</div>
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
</div>