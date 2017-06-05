<div id="section-title">
    <div class="container">
        <h2 class="page-title">Productos
            <small>
                {$producto.NOMBRE}
            </small>
        </h2>
    </div>
</div>
<div class="container wrap">
    <ol class="breadcrumb">
        <li><a href="/">Inicio</a></li>
        <li><a href="{$path}/products">Tienda</a></li>
        <li><a href="{$path}/products/category/{$cat_link}">{$categoria}</a></li>
        <li class="active">
            {$producto.NOMBRE}
        </li>
    </ol>
    <div class="row">
        <div class="col-lg-5">
            <div id="prod-img">
                <img class="img-zoom" src="{$path}/images/products/{$producto.ID}.jpg">
            </div>
        </div>
        <div class="col-lg-7">
            <input type="hidden" id="hdnPID" value="{$producto.ID}">
            <input type="hidden" id="hdnCID" value="{$producto.ID_CAT}">
            <input type="hidden" id="hdnPRECIO" value="{$producto.PRECIO}">
            <h3 class="prod-details-tit">{$producto.NOMBRE}</h3>
            <hr>
            {if $producto.DESCRIPCION_CORTA}
                <em>"{$producto.DESCRIPCION_CORTA}"</em>
            {/if}
            <div class="row">
                <div class="col-lg-6">
                    <div class="prod-details-spn">Cantidad</div>
                    <div class="prod-details-det">
                        <select id="txtCantidad" class="form-cant">
                            {for $i=1 to $producto.STOCK}
                                <option value="{$i}">{$i}</option>
                            {/for}
                        </select>
                    </div>
                    <div class="prod-details-spn">Precio</div>
                    <div class="prod-details-det">
                        <span class="prod-item-price">S/. <span id="price">{$producto.PRECIO|string_format:"%.2f"}</span></span>
                    </div>
                    <div class="prod-details-spn">Métodos de Pago</div>
                    <div class="prod-details-det">
                        <img src="{$path}/images/payments/visa-curved-32px.png" alt="">
                        <img src="{$path}/images/payments/mastercard-curved-32px.png" alt="">
                        <img src="{$path}/images/payments/american-express-curved-32px.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="prod-details-spn">Stock</div>
                    <div class="prod-details-det">{$producto.STOCK} unidades.</div>
                    <button type="button" id="btnAddCart" class="btn btn-products"><span class="glyphicon glyphicon-shopping-cart"></span> Agregar al Carrito</button>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <span class="prod-details-desc">Descripción</span>
            {$producto.DESCRIPCION}
        </div>
    </div>
</div>