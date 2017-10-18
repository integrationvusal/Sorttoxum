{extends file="base.tpl"}

{block name="page-title"}Main page{/block}

{block name="slider"}
<div id="sliderFrame">
	<div id="slider">
		{foreach from=$slider key=k item=sliderItem}
			{if $k eq 0}
			<a href="javascript:void(0)" target="_blank">
				<img src="{$public_url}/{$sliderItem.image}" alt="" />
			</a>
			{else}
			<a class="lazyImage" href="{$public_url}/{$sliderItem.image}">{$sliderItem.title_text}</a>
			{/if}
		{/foreach}
	</div>
	<!--thumbnails-->
	<div id="thumbs">
		{foreach from=$slider item=sliderItem}
		<div class="thumb">
			<div class="thumb-content"><h3><a href="{$sliderItem.url}" target="_blank">{$sliderItem.title_text}</a></h3>{$sliderItem.description}</div>
			<div style="clear:both;"></div>
		</div>
		{/foreach}

	</div>
	<!--clear above float:left elements. It is required if above #slider is styled as float:left. -->
	<div class="clear-both"></div>
</div>
{/block}

{block name="content"}
<div class="plants_seeds_block">
	<div class="plants_seeds_block_left">
		{foreach from=$menuTreeItems item=treeItem name=menuContent}
			{if $menuModelItems[$treeItem.id]->r_id->value == 15}
				{if isset($treeItem.items)}
					{foreach from=$treeItem.items item=treeSubItem}
					<div class="plants_seeds">
						<h3>{$mainPageItems[$treeSubItem.id]->menuItemTitle->value}</h3>
						{if isset($treeSubItem.items)}
						<div class="plants_seeds_inside">
							<ul class="list-unstyled">
								{foreach from=$treeSubItem.items item=treeSub3Item}
								<li>
									<a href="{$menuModelItems[$treeSub3Item.id]->url}">{$mainPageItems[$treeSub3Item.id]->menuItemTitle->value}</a>
								</li>
								{/foreach}
							</ul>
						</div>
						{/if}
					</div>
					{/foreach}
				{/if}
			{/if}
		{/foreach}
	</div>
	<div class="plants_seeds_block_right">
		<h3>{$menuModelItems[46]->menuItemTitle->value}</h3>
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

{block name="news_block"}
	<div class="news_block">
		<div class="news_block_inside">

			<div class="row">
				<div class="col-md-6">
					<a href="http://sorttoxumagro.gov.az/az/news/view/1"><h3>XƏBƏRLƏR</h3></a>
					<hr>
					{if !empty($news->image->value)}
						<img src="{$public_url}/{$news->image->value}">
					{/if}
					<h4>{$news->itemTitle->value}</h4>
					<a href="{$app_url}/{$currentLang}/news/view/{$news->r_id->value}"><p>{$news->description->value}</p></a>
					<p><span>{$news->date->value}</span></p>
				</div>
				<div class="col-md-6">
					<a href="http://sorttoxumagro.gov.az/az/ads/view/73"><h3>ELANLAR</h3></a>
					<hr>
					{if !empty($ad->image->value)}
						<img src="{$public_url}/{$ad->image->value}">
					{/if}
					<h4>{$ad->itemTitle->value}</h4>
					<a href="{$app_url}/{$currentLang}/ads/view/{$ad->r_id->value}"><p>{$ad->description->value}</p></a>
					<p><span>{$ad->date->value}</span></p>
				</div>
			</div>
		</div>
	</div>
{/block}

{block name="foto_video"}
<div class="foto_video">
	<div class="foto_video_inside">
		<div class="row">
			<div class="col-md-6">
				<h3>FOTO</h3>
				<div id="owl-demo-foto">
				{foreach from=$photos item=p}
					<a href="{$app_url}/{$currentLang}/gallery/photo/item/{$p->id->value}">
						<div class="item img-thumbnail">
							<div style="width:100px; height:60px; overflow:hidden"><img src="{$public_url}/{$p->image->value}" width="100"></div>
						</div>
					</a>
				{/foreach}
				</div>

			</div>

			<div class="col-md-6">
				<h3>VİDEO</h3>

				<div id="owl-demo-video">
				{foreach from=$videos item=v}
					<a href="{$app_url}/{$currentLang}/gallery/video/item/{$v->id->value}">
						<div class="item img-thumbnail">
							<div style="width:100px; height:60px; overflow:hidden"><img src="{$public_url}/{$v->thumb->value}" width="100"></div>
						</div>
					</a>
				{/foreach}
				</div>
			</div>
		</div>
	</div>
</div>
{/block}

{block name="elan_frame"}
	<!--div class="elan_frame">
		<div class="elan_frame_in">
			<ul class="list-unstyled">

				<li>
					<a href="#">
						<img src="{$static_url}/img/elektron.png">
						<h4>Elektron xidmətlər</h4>
					</a>
				</li>
				<li>
					<a href="#">
						<img src="{$static_url}/img/bazar.png">
						<h4>Bazar məlumatları</h4>
					</a>
				</li>

				<li>
					<a href="#">
						<img src="{$static_url}/img/istifade.png">
						<h4>İstifadə qaydaları</h4>
					</a>
				</li>
				<li>
					<a href="#">
						<img src="{$static_url}/img/agrar.png">
						<h4>Agrar bazar</h4>
					</a>
				</li>
			</ul>
			<div class="clear-both"></div>
		</div>
	</div-->
{/block}

{block name="faydali_linkler"}
	<div class="faydali_linkler">

		<h3 class="text-bold text-center">FAYDALI LİNKLƏR</h3>
		<a href="http://www.agro.gov.az" target="_blank"><img src="{$public_url}/fl_0.png"></a>
		<a href="http://www.agrolizing.gov.az" target="_blank"><img src="{$public_url}/fl_1.png"></a>
		<a href="http://www.adau.edu.az" target="_blank"><img src="{$public_url}/fl_2.png"></a>
		<a href="http://www.dfnx.gov.az" target="_blank"><img src="{$public_url}/fl_3.png"></a>
		<a href="http://texnaz.gov.az" target="_blank"><img src="{$public_url}/fl_4.png"></a>
		<a href="http://www.vet.gov.az" target="_blank"><img src="{$public_url}/fl_5.png"></a>

	</div>
{/block}