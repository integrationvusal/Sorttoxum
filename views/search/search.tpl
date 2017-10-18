{extends file="base.tpl"}

{block name="page-title"}
	:: Search Result
{/block}

{block name="content"}
	<div class="plants_seeds_block">
		<div class="plants_seeds_content_block_left_about" style="width: 100% !important;">
			<h4>Search results</h4>
			{if count($foundData)}
				{assign var="i" value=1}
				{foreach from=$foundData item=n}
					<div style="padding-bottom: 10px">
						<h5>{$i++}. <a href="{$app_url}/{$currentLang}/{$n->url->value}">{$n->recordTitle->value}</a></h5>
						{$n->content->value}
					</div>
				{/foreach}
			{else}
				Searchable text not found
			{/if}
			<nav>
				<ul class="pagination">
					{foreach from=$paginator item=p}
					{if $p.active}
						<li><a href="{$app_url}/{$currentLang}/search/{$searchText}/page/{$p.page}" class="active">{$p.title}</a></li>
					{else}
						{if $p.disabled}
							<li class="disabled"><a href="{$app_url}/{$currentLang}/search/{$searchText}/page/{$p.page}">{$p.title}</a></li>
						{else}
							<li><a href="{$app_url}/{$currentLang}/search/{$searchText}/page/{$p.page}">{$p.title}</a></li>
						{/if}
					{/if}
					{/foreach}
				</ul>
			</nav>
		</div>
		<div class="clear-both"></div>
	</div>
{/block}