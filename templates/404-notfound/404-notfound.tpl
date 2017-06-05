{extends file="../index.tpl"}
{block name="content"}
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <img src="{$path}/images/bg_404.png" alt="404">
                    <p>{$smarty.server.REMOTE_ADDR}</p>
                </div>
            </div>
        </div>
    </div>
{/block}