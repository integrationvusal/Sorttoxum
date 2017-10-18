{extends file="base.tpl"}

{block name="page-title"}
	:: {$news->itemTitle->value}
{/block}

{block name="content"}
	<div class="view-page-content font16" style="width: 96%;">
		<div class="page-title font25">{$news->itemTitle->value}</div>
		{$news->content->value}
		<p align="right"><a href="{$app_url}/{$currentLang}/news" class="font13 color-green" >{$messages.common.news}</a></p>
		
		{if count($comments) || $logged_in}
		<div class="comments-container">
			<div class="page-title comments-head-title font25">{$messages.comments.title}</div>
			<div class="comments-left-side">
				{if count($comments)}
					{foreach from=$comments item=c}
						<div class="comment-container">
							<div class="user-avatar">
								<img src="{$public_url}/{$c.avatar}" />
							</div>
							<div class="user-info">
								<div class="user-name font15">{$c.name} {$c.surName}</div>
								<div class="user-comment font13">{$c.commentText}</div>
							</div>
							<div class="comment-date font13">{$c.date|date_format:"%d.%m.%Y"}</div>
							<div class="clear"></div>
						</div>
					{/foreach}
				{/if}
			</div>
			<div class="comments-right-side">
				{if $logged_in}
				<div class="comment-text">
					<div id="comments-error-container"></div>
					<br/>
					<textarea id="comment-text" class="font13 right" style="color: #ccc;" onclick="this.value = ''">{$messages.common.write_your_comment}</textarea>
					<div class="clear"></div>
				</div>
				<div class="submit-button comment-submit-button" id="add-comment" news-id="{$news->r_id->value}">{$messages.common.send}</div>
				{/if}
			</div>
			<div class="clear"></div>
		</div>
		{/if}
	</div>
	<div class="clear"></div>
{/block}