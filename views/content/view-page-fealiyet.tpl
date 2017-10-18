{extends file="base.tpl"}

{block name="page-title"}
    :: {$page->menuItemTitle->value}
{/block}

{block name="content"}
<div class="plants_seeds_block">
    <div class="plants_seeds_content_block_left">

        <ul class="list-unstyled">
            {foreach from=$secondLevel key=k item=secLev}
            <li><h3>{$secLev->menuItemTitle->value}<h3></li>
            <li>
                <ul class="list-unstyled">
                    {foreach from=$thirdLevel[$k] item=tLev}
                        {if $page->r_id->value == $tLev->r_id->value}
                            <li><a href="{$tLev->url->value}" class="text-bold">{$tLev->menuItemTitle->value}</a></li>
                        {else}
                            <li><a href="{$tLev->url->value}">{$tLev->menuItemTitle->value}</a></li>
                        {/if}
                    {/foreach}
                </ul>
            </li>
            {/foreach}
        </ul>

    </div>

    <div class="plants_seeds_content_block_right">
        <h4>{$page->menuItemTitle->value}</h4>
        {$page->content->value}
    </div>
    <div class="clear-both"></div>
</div>
{/block}