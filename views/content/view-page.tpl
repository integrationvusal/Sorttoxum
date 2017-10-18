{extends file="base.tpl"}

{block name="page-title"}
	:: {$page->menuItemTitle->value}
{/block}

{block name="content"}
	<div class="plants_seeds_block">
		<div class="plants_seeds_content_block_left_about">
			<h4>{$page->menuItemTitle->value}</h4>
			{if !empty($childPages)}
			{assign var=i value=0}
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			{foreach from=$childPages item=p}
			{assign var=i value=$i+1}

				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading{$i}">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse{$i}" aria-expanded="false" aria-controls="collapse{$i}">
							{$p->menuItemTitle->value}
						</a>
					</div>
					{if $p->r_id->value == $currentPage}
						<div id="collapse{$i}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{$i}">
					{else}
						<div id="collapse{$i}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{$i}">
					{/if}
							<div class="panel-body">
								{$p->content->value}
							</div>
						</div>
				</div>


			{/foreach}
			</div>
			{/if}
			{$page->content->value}
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