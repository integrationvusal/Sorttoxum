{extends file="base.tpl"}

{block name="page-title"}
    :: {$page->menuItemTitle->value}
{/block}

{block name="content"}
<script>
    /**
     * Type description
     * 0 -> "NEWS"
     * 1 -> "ADS"
     * @param pageId
     */
    function getNewsData(pageId){
        var request = $.ajax({
            url: '{$app_url}/{$currentLang}/news/get/',
            type: "POST",
            data: 'pageId=' + pageId,
            dataType: 'json'
        });

        request.done(function(data) {
            console.log(data);
            var newsData = data['newsData'];
            $news_area = "";
            for(var i = 0; i < newsData.length; i++){
                var style = "";
                {if $news}
                if(newsData[i].id == {$news->r_id->value}) style = 'class="news_block_active"';
                {/if}
                $news_area += '<li><a ' + style + ' href="{$app_url}/{$currentLang}/news/view/' + newsData[i].id + '">' + newsData[i].description + '</a><p>' + newsData[i].date + '</p></li>';
            }
            $("#news_data_area").html($news_area);

            var newsPaginator = data['newsPaginator'];
            $paginator_area = "";
            for(var i = 0; i < newsPaginator.length; i++){
                if(newsPaginator[i].active){
                    $paginator_area += '<li class="active"><a href="javascript:void(0)" onclick="getNewsData(\'' + newsPaginator[i].page + '\')">' + newsPaginator[i].title + '</a></li>';
                } else {
                    if(newsPaginator[i].disabled){
                        $paginator_area += '<li class="disabled" onclick="getNewsData(\'' + newsPaginator[i].page + '\')"><a href="javascript:void(0)">' + newsPaginator[i].title + '</a></li>';
                    } else {
                        $paginator_area += '<li><a href="javascript:void(0)" onclick="getNewsData(\'' + newsPaginator[i].page + '\')">' + newsPaginator[i].title + '</a></li>';
                    }
                }
            }
            $("#news_pagination_area").html($paginator_area);
        });

        request.fail(function(jqXHR, textStatus) {
            alert( "Request failed: " + textStatus );
        });
    }

    /**
     *
     * @param pageId
     */
    function getAdsData(pageId){
        var request = $.ajax({
            url: '{$app_url}/{$currentLang}/ads/get/',
            type: "POST",
            data: 'pageId=' + pageId,
            dataType: 'json'
        });

        request.done(function(data) {
            console.log(data);
            var adsData = data['adsData'];
            $ads_area = "";
            for(var i = 0; i < adsData.length; i++){
                var style = "";
                {if $ads}
                if(adsData[i].id == {$ads->r_id->value}) style = 'class="news_block_active"';
                {/if}
                $ads_area += '<li><a ' + style + ' href="{$app_url}/{$currentLang}/ads/view/' + adsData[i].id + '">' + adsData[i].description + '</a><p>' + adsData[i].date + '</p></li>';
            }
            $("#ads_data_area").html($ads_area);

            var adsPaginator = data['adsPaginator'];
            $paginator_area = "";
            for(var i = 0; i < adsPaginator.length; i++){
                if(adsPaginator[i].active){
                    $paginator_area += '<li class="active"><a href="javascript:void(0)" onclick="getAdsData(\'' + adsPaginator[i].page + '\')">' + adsPaginator[i].title + '</a></li>';
                } else {
                    if(adsPaginator[i].disabled){
                        $paginator_area += '<li class="disabled" onclick="getAdsData(\'' + adsPaginator[i].page + '\')"><a href="javascript:void(0)">' + adsPaginator[i].title + '</a></li>';
                    } else {
                        $paginator_area += '<li><a href="javascript:void(0)" onclick="getAdsData(\'' + adsPaginator[i].page + '\')">' + adsPaginator[i].title + '</a></li>';
                    }
                }
            }
            $("#ads_pagination_area").html($paginator_area);
        });

        request.fail(function(jqXHR, textStatus) {
            alert( "Request failed: " + textStatus );
        });
    }

    $( document ).ready(function() {
        getNewsData('{$news_active_page}');
        getAdsData('{$ads_active_page}');
    });
</script>

<div class="plants_seeds_block">
    <div class="plants_seeds_news_block_left">
        {if $first == 1}
            <h3>ELANLAR</h3>
            <ul class="list-unstyled" id="ads_data_area">

            </ul>
            <nav>
                <ul class="pagination" id="ads_pagination_area">

                </ul>
            </nav>
            <h3>XƏBƏRLƏR</h3>
            <ul class="list-unstyled" id="news_data_area">

            </ul>
            <nav>
                <ul class="pagination" id="news_pagination_area">

                </ul>
            </nav>
        {else}
            <h3>XƏBƏRLƏR</h3>
            <ul class="list-unstyled" id="news_data_area">

            </ul>
            <nav>
                <ul class="pagination" id="news_pagination_area">

                </ul>
            </nav>

            <h3>ELANLAR</h3>
            <ul class="list-unstyled" id="ads_data_area">

            </ul>
            <nav>
                <ul class="pagination" id="ads_pagination_area">

                </ul>
            </nav>
        {/if}
    </div>

    {if $news}
        <div class="plants_seeds_content_block_right">
            <h4>{$news->itemTitle->value}</h4>
            {if $news->image->value}
                <img src="{$public_url}/{$news->image->value}" alt="">
            {/if}
            {$news->content->value}
        </div>
    {/if}
    {if $ads}
        <div class="plants_seeds_content_block_right">
            <h4>{$ads->itemTitle->value}</h4>
            {if $ads->image->value}
                <img src="{$public_url}/{$ads->image->value}" alt="">
            {/if}
            {$ads->content->value}
        </div>
    {/if}
    <div class="clear-both"></div>
</div>
{/block}