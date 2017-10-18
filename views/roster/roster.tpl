{extends file="base.tpl"}

{block name="page-title"}
    :: {$messages.common.roster}
{/block}

{block name="content"}
    
    {literal}
        <style type="text/css">
            .roster-field{float:left;width:65%;color:#7b3f00;font-size:16px;font-family:Georgia,'Times New Roman',Times,serif;}
            h4.roster-field{clear:left;width:20%;}
            .select-button{border-radius: .5em;padding: 10px;margin-left: 3%;float:left;width:11%;margin-top:-4%;}
            .select-iframe{margin: 60px 0 0 -5px;border: 0}
        </style>
    {/literal}

        <div class="plants_seeds_block">
            <div class="plants_seeds_content_block_left_about">
                <h4>{$messages.common.roster}</h4>
                <form>
                    <h4 class="roster-field">Bitkinin adı:</h4>
                    <select name="Plant" class="roster-field">
                        <option value="">Bitkinin adını seçin ...</option>
                        {foreach from=$plants item=plant}
                            <option value="{$plant.plant}">{$plant.plant}</option>
                        {/foreach}
                    </select>
                    <h4 class="roster-field">Sortun adı:</h4>
                    <select name="Sort" class="roster-field">
                        <option value="">Sortun adını seçin ...</option>
                        {foreach from=$sorts item=sort}
                            <option value="{$sort.name}">{$sort.name}</option>
                        {/foreach}
                    </select>
                    <button formaction="/roster_result.php" formmethod="POST" formtarget="output" class="select-button">Axtar</button>
                    <p>
                        <iframe name="output" height="775" width="658" class="select-iframe"></iframe>
                    </p>
                </form>
            </div>
        </div>
        <div class="plants_seeds_block_right">
            <div class="plants_seeds_block_right_inside">
                <ul class="list-unstyled">
                    {foreach from=$menuTreeItems item=treeItem name=menuContent}
                        {if $menuModelItems[$treeItem.id]->r_id->value == 44}
                            {if isset($treeItem.items)}
                                {foreach from=$treeItem.items item=treeSubItem}
                                    {if $menuModelItems[$treeSubItem.id]->r_id->value == 45}
                                        {if isset($treeSubItem.items)}
                                            {foreach from=$treeSubItem.items item=treeSub3Item}
                                                <a href="{$menuModelItems[$treeSub3Item.id]->url}"><li>{$menuModelItems[$treeSub3Item.id]->menuItemTitle->value}</li></a>
                                            {/foreach}
                                        {/if}
                                    {/if}
                                {/foreach}
                            {/if}
                        {/if}
                    {/foreach}
                </ul>
            </div>

        </div>
        <div class="clear-both"></div>
    </div>
{/block}