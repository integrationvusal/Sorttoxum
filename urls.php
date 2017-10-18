<?php
    $lang = join('|', array_keys($__app['languages']));
    
    $__urlPatterns = Array(
        'app' => Array(
			Array('|\/','ApplicationController','main', 'app'),
			Array('(?P<lang>[a-z]{2})|\/','ApplicationController','main', 'app'),

			//roster
			Array('(?P<lang>[a-z]{2})\/roster','RosterController','view', 'roster'),
			
			// news
			Array('(?P<lang>[a-z]{2})\/news|\/','NewsController','viewAll', 'news', Array('page_id' => '0')),
			Array('(?P<lang>[a-z]{2})\/news\/page\/(?P<page_id>[0-9]{1,5})','NewsController','viewAll', 'news'),
			Array('(?P<lang>[a-z]{2})\/news\/get\/','NewsController','getNewsData', 'news'),
			Array('(?P<lang>[a-z]{2})\/ads\/get\/','NewsController','getAdsData', 'news'),
			Array('(?P<lang>[a-z]{2})\/news\/view\/(?P<news_id>[0-9]{1,5})','NewsController','viewNews', 'news'),
			Array('(?P<lang>[a-z]{2})\/ads\/view\/(?P<ads_id>[0-9]{1,5})','NewsController','viewAds', 'news'),
			Array('(?P<lang>[a-z]{2})\/news\/add\/comment\/(?P<news_id>[0-9]{1,5})','NewsController','addComment', 'news'),
			
			// contact
			Array('(?P<lang>[a-z]{2})\/contact','ContactController','view', 'contact'),
			Array('(?P<lang>[a-z]{2})\/contact\/add','ContactController','add', 'contact'),
			Array('(?P<lang>[a-z]{2})\/contact\/refreshcaptcha','ContactController','refreshCaptcha', 'contact'),

			// Gallery
			Array('(?P<lang>[a-z]{2})\/gallery\/photo','GalleryController','viewPhotos', 'gallery', Array('page_id' => '0')),
			Array('(?P<lang>[a-z]{2})\/gallery\/photo\/page\/(?P<page_id>[0-9]{1,5})','GalleryController','viewPhotos', 'gallery'),
			Array('(?P<lang>[a-z]{2})\/gallery\/photo\/item\/(?P<photo_id>[0-9]{1,5})','GalleryController','viewPhoto', 'gallery', Array('photo_id' => '0')),
			Array('(?P<lang>[a-z]{2})\/gallery\/video','GalleryController','viewVideos', 'gallery', Array('page_id' => '0')),
			Array('(?P<lang>[a-z]{2})\/gallery\/video\/page\/(?P<page_id>[0-9]{1,5})','GalleryController','viewVideos', 'gallery'),
			Array('(?P<lang>[a-z]{2})\/gallery\/video\/item\/(?P<video_id>[0-9]{1,5})','GalleryController','viewVideo', 'gallery', Array('video_id' => '0')),


			// search
			Array('(?P<lang>[a-z]{2})\/search\/(?P<search_text>[0-9а-яёструфхцчшщыюьъa-zəöğüçşА-ЯЁСТРУФХЦЧШЩЫЮАA-ZƏÖĞÜÇŞ,\.\s]{1,20})|\/page\/(?P<page_number>[0-9]{1,5})','SearchController','search', 'search', Array('page_number' => '1')),
			
			// view page
			Array('(?P<lang>[a-z]{2})\/view-page\/(?P<page_id>[0-9]{1,5})|\/(?P<page_title>.*)','ContentController','viewPage', 'content'),
			
			// image resizer
			Array('imageresizer\/resize\/(?P<width>[0-9]{1,4})\/(?P<height>[0-9]{1,4})\/(?P<file_path>.*+)','ImageResizer','resize', 'utils'),
			// static files
			Array('get_static\/(?P<file_type>[a-z0-9_-]{1,30})|\/|(?P<module_name>[a-z0-9_-]{1,30})','StaticController','getStatic', 'utils'),
			// page not found
            Array('.*','ApplicationController','pageNotFound', 'app'),
			
        ),
    );

?>