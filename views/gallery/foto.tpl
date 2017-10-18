{extends file="base.tpl"}

{block name="page-title"}
    :: {$page->menuItemTitle->value}
{/block}

{block name="content"}
    <div class="gallery_block">
        <div class="gallery_photo">

            <h3>FOTOLAR</h3>
            <div id="gallery" style="display:none;">
                {foreach from=$photos item=p}
                <a href="">
                    <img id="photo{$p->id->value}" alt="{$p->name->value}"
                         src="{$public_url}/{$p->thumb->value}"
                         data-image="{$public_url}/{$p->image->value}"
                         data-description="{$p->description->value}"
                         style="display:none">
                </a>
                {/foreach}
            </div>
            <script type="text/javascript">

                jQuery(document).ready(function(){

                    jQuery("#gallery").unitegallery({
                        tiles_type:"justified"
                    });

                });
            </script>
        </div>

        <nav style="text-align: center">
            <ul class="pagination" id="ads_pagination_area">
                {foreach from=$paginator item=p}
                    {if $p.active == 1}
                        <li class="active"><a href="{$app_url}/{$currentLang}/gallery/photo/page/{$p.page}">{$p.title}</a></li>
                    {else}
                        {if $p.disabled == 1}
                            <li class="disabled"><a href="{$app_url}/{$currentLang}/gallery/photo/page/{$p.page}">{$p.title}</a></li>
                        {else}
                            <li><a href="{$app_url}/{$currentLang}/gallery/photo/page/{$p.page}">{$p.title}</a></li>
                        {/if}
                    {/if}
                {/foreach}
            </ul>
        </nav>
    </div>
{/block}