<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BİTKİ VƏ TOXUM {block name="page-title"}{/block}</title>

    <!-- Bootstrap -->
    <link href="{$app_url}/static/stylesheets/bootstrap.css" rel="stylesheet">
    <link href="{$app_url}/static/stylesheets/bootstrap-theme.css" rel="stylesheet">
    <link href="{$app_url}/static/stylesheets/style.css" rel="stylesheet">
    <link href="{$app_url}/static/stylesheets/owl.carousel.css" rel="stylesheet">
    <link href="{$app_url}/static/stylesheets/owl.theme.css" rel="stylesheet" >
    <link href="{$app_url}/static/stylesheets/ihover.css" rel="stylesheet">
    <link href="{$app_url}/static/stylesheets/js-image-slider.css" rel="stylesheet">
    <link href="{$app_url}/static/stylesheets/ddmenu.css" rel="stylesheet">
    <link href="{$app_url}/static/stylesheets/unite-gallery.css" rel="stylesheet">
    <script src="{$app_url}/static/js/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="{$app_url}/static/js/jssor.slider.mini.js"></script>
    <script type="text/javascript" src="{$app_url}/static/js/js-image-slider.js"></script>
    <script src="{$app_url}/static/js/bootstrap.js"></script>
    <script src="{$app_url}/static/js/owl.carousel.js"></script>
    <script src="{$app_url}/static/js/ddmenu.js"></script>
    <script src="{$app_url}/static/js/plant_seed.js"></script>
    <script src="{$app_url}/static/js/ug-theme-tiles.js"></script>
    <script src="{$app_url}/static/js/ug-theme-video.js"></script>
    <script src="{$app_url}/static/js/unitegallery.min.js"></script>
</head>

<body>
<!-- header begin -->

<header>
    <div class="header_footer_inside">

        <div class="header_footer_inside_left">
            <a href="{$app_url}">
                <img src="{$static_url}/img/logo.png">
                <div class="logo_text">
                    <h4 class="text-bold">AZƏRBAYCAN RESPUBLIKASININ KƏND TƏSƏRRÜFATI NAZİRLİYİ YANINDA</h4>
                    <h4 class="text-white text-spacing">BİTKİ SORTLARININ QEYDİYYATI VƏ TOXUM NƏZARƏTİ ÜZRƏ DÖVLƏT XİDMƏTİ</h4>
                </div>
            </a>
        </div>

        <div class="header_footer_inside_right">
            <div class="lang">
                <a href="">AZE</a>
                <a href="">RUS</a>
                <a href="">ENG</a>
            </div>

            <div class="cagri">
                <img src="{$static_url}/img/cagri.png">
            </div>

        </div>
        <div class="clear-both"></div>

        <div class="row">
            <div class="col-lg-9">
                <nav id="ddmenu">
                    <div class="menu-icon"></div>
                    <ul>
                        {foreach from=$menuTreeItems item=treeItem name=menuContent}
                            {if $menuModelItems[$treeItem.id]->r_id->value neq 44}
                                {if $menuModelItems[$treeItem.id]->visible->value > 0}
                                <li class="{$menuModelItems[$treeItem.id]->class->value}">
                                    {if $menuModelItems[$treeItem.id]->clickable->value == 0}
                                        <span class="top-heading">{$menuModelItems[$treeItem.id]->menuItemTitle->value}</span>
                                    {else}
                                        <a class="top-heading" href="{$menuModelItems[$treeItem.id]->url}">{$menuModelItems[$treeItem.id]->menuItemTitle->value}</a>
                                    {/if}
                                    {if isset($treeItem.items)}
                                    <i class="caret"></i>
                                    <div class="dropdown {$menuModelItems[$treeItem.id]->class->value}">
                                        <div class="dd-inner">
                                            <ul class="column">
                                                {foreach from=$treeItem.items item=treeSubItem}
                                                {if $menuModelItems[$treeSubItem.id]->visible->value > 0}
                                                    {if $menuModelItems[$treeSubItem.id]->newColumn->value > 0}
                                                    </ul>
                                                    <ul class="column">
                                                    {/if}
                                                    {if $menuModelItems[$treeSubItem.id]->clickable->value > 0}
                                                    <li><a href="{$menuModelItems[$treeSubItem.id]->url}"><h4>{$menuModelItems[$treeSubItem.id]->menuItemTitle->value}</h4></a></li>
                                                    {else}
                                                    <li><h4>{$menuModelItems[$treeSubItem.id]->menuItemTitle->value}</h4>
                                                    {/if}
                                                        {if isset($treeSubItem.items)}
                                                        <ul class="column">
                                                            {foreach from=$treeSubItem.items item=treeSub3Item}
                                                            {if $menuModelItems[$treeSub3Item.id]->visible->value > 0}
                                                            <li><a href="{$menuModelItems[$treeSub3Item.id]->url}">{$menuModelItems[$treeSub3Item.id]->menuItemTitle->value}</a></li>
                                                            {/if}
                                                            {/foreach}
                                                        </ul>
                                                        {/if}
                                                    </li>
                                                {/if}
                                                {/foreach}
                                            </ul>
                                        </div>
                                    </div>
                                    {/if}
                                </li>
                                {/if}
                            {/if}
                        {/foreach}
                    </ul>


                </nav>
            </div>
            <div class="col-lg-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Axtar" name="search_text">
                    <span class="input-group-btn">
                        <button class="btn btn-success glyphicon glyphicon-search" id="search_button" type="button"></button>
                    </span>
                </div>
            </div>
        </div>

    </div>
</header>
<script>
    $("#search_button").click(function(){
        document.location.replace('{$app_url}/{$currentLang}/search/' + $("input[name='search_text']").val());
    });
    $("input[name='search_text']").keyup(function (e) {
        if (e.keyCode == 13) {
            document.location.replace('{$app_url}/{$currentLang}/search/' + $("input[name='search_text']").val());
        }
    });
</script>


<!-- header end -->

<div id="wrapper">

    {block name="slider"}{/block}

    {block name="content"}{/block}
    {block name="news_block"}{/block}

    {block name="foto_video"}{/block}


    {block name="elan_frame"}{/block}


    <div class="clear-both"></div>



    {block name="faydali_linkler"}{/block}
    <div class="clear-both"></div>
</div>


<footer>

    <div class="header_footer_inside">
        <div class="footer_above">
            <div class="row">
                <div class="col-md-4">
                    <img src="{$static_url}/img/location.png">
                    <p>AZ1000, Bakı, Səbail, Üzeyir Hacıbəyov 80</p>
                </div>
                <div class="col-md-4">
                    <img src="{$static_url}/img/phone.png">
                    <p>(+99412) 4987351</p>
                </div>
                <div class="col-md-4">
                    <img src="{$static_url}/img/elektron1.png">
                    <p>
					<a href="mailto:mail@sorttoxumagro.gov.az" style="color:white">mail@sorttoxumagro.gov.az</a>
					</p>
				</div>
            </div>
        </div>
        <div class="footer_below">
            <div class="f-left">
                <span class="text-white">© Azərbaycan Respublikasının Kənd Təsərrüfatı Nazirliyi yanında <br>Bitki Sortlarının Qeydiyyatı və Toxum Nəzarəti üzrə Dövlət Xidməti, 2016</span>
            </div>
            <div class="f-right">
                <a href="#"><img src="{$static_url}/img/face.png"></a>
                <a href="#"><img src="{$static_url}/img/twit.png"></a>
                <a href="#"><img src="{$static_url}/img/instag.png"></a>
                <a href="#"><img src="{$static_url}/img/google.png"></a>

            </div>

        </div>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</footer>




</body>

</html>