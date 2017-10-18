{extends file="base.tpl"}

{block name="page-title"}
    :: {$page->menuItemTitle->value}
{/block}

{block name="content"}
    <div class="gallery_block">
        <div class="gallery_video">
            <h3>VİDEOLAR</h3>

            <div id="gallery" style="display:none;">
                {foreach from=$videos item=v}
                <img alt="{$v->name->value}"
                     data-type="youtube"  src="{$public_url}/{$v->thumb->value}"
                     data-image="{$public_url}/{$v->thumb->value}"
                     data-description="{$v->description->value}"
                     data-videoid="{$v->video_url->value}" style="display:none">
                {/foreach}
            </div>

            <script type="text/javascript">

                jQuery(document).ready(function(){

                    jQuery("#gallery").unitegallery({
                        gallery_width:"960",
                        tile_enable_border:true,
                        tile_border_color:"#ffffff",
                        tile_enable_outline:true,
                        tile_outline_color:"#b6b6b6",
                        tile_shadow_color:"#8B8B8B",
                        tile_overlay_opacity:0.6,
                        tile_enable_image_effect:true,
                        tile_image_effect_type:"blur",
                        tile_image_effect_reverse:true,
                        tile_enable_textpanel:true,
                        tile_textpanel_bg_color:"#332e68",
                        tile_textpanel_bg_opacity:0.9,
                        tile_textpanel_title_text_align:"center",
                        lightbox_textpanel_enable_title:false,
                        lightbox_textpanel_enable_description:true,
                        lightbox_textpanel_desc_color:"e5e5e5",
                        tiles_col_width:200,
                        tiles_space_between_cols:30
                    });

                });

            </script>


        </div>

        <nav style="text-align: center">
            <ul class="pagination" id="ads_pagination_area">
                {foreach from=$paginator item=p}
                    {if $p.active == 1}
                        <li class="active"><a href="{$app_url}/{$currentLang}/gallery/video/page/{$p.page}">{$p.title}</a></li>
                    {else}
                        {if $p.disabled == 1}
                            <li class="disabled"><a href="{$app_url}/{$currentLang}/gallery/video/page/{$p.page}">{$p.title}</a></li>
                        {else}
                            <li><a href="{$app_url}/{$currentLang}/gallery/video/page/{$p.page}">{$p.title}</a></li>
                        {/if}
                    {/if}
                {/foreach}
            </ul>
        </nav>

    </div>
{/block}