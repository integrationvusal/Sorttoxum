<?php
	
    class ApplicationController extends Controller {
		
		public static function before($request, $vars = Array()) {

		}
		
		public static function main($request, $vars = Array()) {
			
			$rIds = Array();

			$photos = PhotoModel::getPhotos(1, 10);
			$videos = VideoModel::getVideos(1, 10);

			$news = NewsModel::getLastNews(1, 1, Application::$storage['lang']);
			$ad = NewsModel::getLastAds(1, 1, Application::$storage['lang']);

			$mainPageItems = MenuModel::getAllRecords(Application::$storage['lang'], 'treeItemId', false);

			self::renderTemplate('main' . ds . 'main.tpl',Array(
				'csrf_key' => Application::getCSRFKey(),
				'photos' => $photos,
				'videos' => $videos,
				'news' => empty($news) ? $news : $news[0],
				'ad' => empty($ad) ? $ad : $ad[0],
				'mainPageItems' => $mainPageItems,
			));
        }

        public static function pageNotFound() {
            self::renderTemplate('404' . ds . '404.tpl', Array(
				//'csrf_key' => Application::getCSRFKey()
			));
			die();
        }

    }
?>