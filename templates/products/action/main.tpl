<div id="section-title">
    <div class="container">
        <h2 class="page-title">Productos
            <small>
                {if $subcategoria}
                    {$subcategoria}
                {elseif $categoria}
                    {$categoria}
                {else}
                    Todos los productos
                {/if}
            </small>
        </h2>
    </div>
</div>
<div class="container wrap">
    <ol class="breadcrumb">
        <li><a href="/">Inicio</a></li>
        <li><a href="{$path}/products">Tienda</a></li>
        <li class="active">
            {if $subcategoria}
                {$subcategoria}
            {elseif $categoria}
                {$categoria}
            {else}
                Todos los productos
            {/if}
        </li>
    </ol>
    <div class="row">
        <div class="col-lg-3">
            <table class="table-prod-main">
                <thead>
                    <tr>
                        <th>Categorías</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$categorias item=entry}
                        <tr>
                            <td>
                                <a href="{$path}/products/category/{$entry.LINK}">{$entry.NOMBRE}</a>
                            </td>
                        </tr>
                    {/foreach}
                    <tr>
                        <td>
                            <a href="{$path}/products/">Todos</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-9">
            <div class="prod-bar-opt">
                <div class="row">
                    <div class="col-lg-3">
                        Total {$total_prod} productos
                    </div>
                    <div class="col-lg-6 text-center">
                        ORDENAR POR:
                        <select name="filter" id="cboFilter">
                            <option value="0"{if $smarty.get.filter eq 0} selected{/if}>Lo más nuevo</option>
                            <option value="1"{if $smarty.get.filter eq 1} selected{/if}>Lo más caro primero</option>
                            <option value="2"{if $smarty.get.filter eq 2} selected{/if}>Lo más barato primero</option>
                        </select>
                    </div>
                    <div class="col-lg-3 text-right">
                        <div class="prod-pagination">
                            {for $i=max(1, $page - 2) to min($page + 2, $total_pages)}
                                {if $i eq $page}
                                    <span class="prod-pag-active">{($i)}</span>
                                {else}
                                    <a href="?page={$i}">{($i)}</a>
                                {/if}
                            {/for}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {foreach from=$productos item=entry}
                    <div class="col-lg-3 col-xs-6 prod-item">
                        <a href="{$path}/products/action/view/{$entry.LINK}">
                            <img src="{$path}/images/products/{$entry.ID}.jpg" class="prod-item-img" align="center">
                        </a>
                        <div class="prod-item-title"><a href="{$path}/products/action/view/{$entry.LINK}">{$entry.NOMBRE}</a></div>
                        <div class="prod-item-price">S/ {$entry.PRECIO|string_format:"%.2f"}</div>
                        <button class="prod-item-add btnAddCartUnit" item-id="{$entry.ID}" item-cat="{$entry.ID_CAT}">+ Agregar al carrito</button>
                    </div>
                {/foreach}
            </div>
            <div class="prod-bar-opt">
                <div class="row">
                    <div class="col-lg-3">
                        Total {$total_prod} productos
                    </div>
                    <div class="col-lg-6 text-center">
                        ORDENAR POR:
                        <select name="filter" id="cboFilter">
                            <option value="1">Lo más nuevo</option>
                            <option value="2">Lo más caro primero</option>
                            <option value="3">Lo más barato primero</option>
                        </select>
                    </div>
                    <div class="col-lg-3 text-right">
                        <div class="prod-pagination">
                            {for $i=max(1, $page - 2) to min($page + 2, $total_pages)}
                                {if $i eq $page}
                                    <span class="prod-pag-active">{($i)}</span>
                                {else}
                                    <a href="?page={$i}">{($i)}</a>
                                {/if}
                            {/for}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>