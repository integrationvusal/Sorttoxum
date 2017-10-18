{extends file="base.tpl"}

{block name="page-title"}
	:: {$messages.news.title}
{/block}

{block name="last_news"}{/block}

{block name="content"}
	<div class="fixed show-in-767 content-child-elements">
		<div class="content-child-elements-left">
			{if count($childPages)}
				<div class="view-page-childs">
					{foreach from=$childPages item=p}
						<div class="child-menu">
							<div class="child-menu-pointer">
								<img src="{$static_url}/img/child-page-pointer.png" />
							</div>
							<div class="child-menu-text">
								{if $request_url == $p->r_id->value}
									<span class="font15" >{$p->menuItemTitle->value}</span>
								{else}
									<a href="{$p->url->value}" class="font15" >{$p->menuItemTitle->value}</a>
								{/if}
							</div>
							<div class="clear"></div>
						</div>
					{/foreach}
				</div>
			{/if}
		</div>
		<div class="content-child-elements-right">
			<div class="content-child-elements-pointer" id="show-content-childs-menu">
				<img src="{$static_url}/img/arrow-to-right.png" class="to-right" />
				<img src="{$static_url}/img/arrow-to-left.png" class="to-left hide" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	
	{if count($childPages)}
		<div class="view-page-childs hide-in-767">
			{foreach from=$childPages item=p}
				<div class="child-menu">
					<div class="child-menu-pointer">
						<img src="{$static_url}/img/child-page-pointer.png" />
					</div>
					<div class="child-menu-text">
						{if $request_url == $p->r_id->value}
							<span class="font15" >{$p->menuItemTitle->value}</span>
						{else}
							<a href="{$p->url->value}" class="font15" >{$p->menuItemTitle->value}</a>
						{/if}
					</div>
					<div class="clear"></div>
				</div>
			{/foreach}
		</div>
	{/if}
	
	<div class="clear show-in-767"></div>
	<div class="view-page-content view-page-content-small font16">
		<div class="page-title news-page-title font25">{$messages.news.title}</div>
		
		{foreach from=$newsArchive item=n}
			<div class="news-archive-item">
				<div class="item-date font13">{$n.date|date_format:"%d/%m/%y"}</div>
				<div class="item-title font20">{$n.itemTitle}</div>
				<div class="item-description font13">
					{$n.description}
					<a href="{$app_url}/{$currentLang}/news/view/{$n.r_id}" class="item-more font13">{$messages.news.more}</a>
				</div>
				<div class="item-comments">
					<div class="comments-icon"><img src="{$static_url}/img/comments-icon.png" /></div>
					<div class="comments-count font13">{$n.comments_count}</div>
					<div class="clear"></div>
				</div>
			</div>
		{/foreach}
		
		{if count($paginator) > 3}
		<div class="paginator-container">
			<div class="paginator-content">
				{foreach from=$paginator item=p}
					{if $currentPage == $p.key}
						<div class="paginator-item paginator-item-active">
							<span class="font13" >{$p.title}</span>
						</div>
					{else}
						<div class="paginator-item">
							{if isset($p.inactive)}
								<span class="font13" style="color: #000;" >{$p.title}</span>
							{else}
								<a href="{$app_url}/{$currentLang}/news/page/{$p.key}" class="font13" >{$p.title}</a>
							{/if}
						</div>
					{/if}
				{/foreach}
				<div class="clear"></div>
			</div>
		</div>
		{/if}
		
	</div>
	<div class="clear"></div>
{/block}