{extends file="../index.tpl"}
{block name="content"}
    <div id="section-title">
        <div class="container">
            <h2 class="page-title">Carrito de Compras</h2>
        </div>
    </div>
    <div class="container wrap">
        <ol class="breadcrumb">
            <li><a href="/">Inicio</a></li>
            <li><a href="{$path}/products">Tienda</a></li>
            <li class="active">
                Carrito de Compras
            </li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                {if !empty($prod)}
                <table width="100%" class="table table-responsive">
                    <tbody>
                    {foreach from=$prod item=entry}
                    <tr>
                        <td>
                            <img src="{$path}/images/products/{$entry.ID_PROD}.jpg" width="100" height="100">
                        </td>
                        <td>
                            <a href="{$path}/products/action/view/{$entry.LINK}">
                                {$entry.NOMBRE}
                            </a>
                        </td>
                        <td>
                            {$entry.CANTIDAD}
                        </td>
                        <td>
                            {$entry.PRECIO|string_format:"%.2f"}
                        </td>
                        <td>
                            {($entry.PRECIO*$entry.CANTIDAD)|string_format:"%.2f"}
                        </td>
                        <td>
                            <a href="javascript:void(0)" del-item="{$entry.ID}">
                                <img src="{$path}/images/delete_button.png" alt="">
                            </a>
                        </td>
                    </tr>
                    {/foreach}
                    <tr>
                        <td colspan="10" align="right">
                            <span class="booking-total-price">Pago Total: S/. {$total|string_format:"%.2f"}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <form action="{$path}/index.php/booking/action/done" method="post">
                    <div class="col-lg-12 form-group text-center">
                        <button type="submit" class="btn btn-danger">Continuar Comprando</button>
                        <button type="submit" class="btn btn-primary">Realizar Pago</button>
                    </div>
                </form>
                {else}
                    <div class="cart-empty-spn">
                        <p>¡Carrito de Compras Vacío! :(</p>
                        <form action="{$path}/products">
                            <button type="submit" class="cart-empty-btn">Ir a la Tienda</button>
                        </form>
                    </div>
                {/if}
            </div>
        </div>
    </div>
{/block}