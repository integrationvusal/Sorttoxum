<?php

	class NewsController extends Controller {

		public static $limit = 4;
	
		public static function viewAll($request, $vars) {
			$lang = Application::$storage['lang'];
			$news = NewsModel::getLastNews(1,1,$lang);
			self::renderTemplate('news' . ds . 'news.tpl', Array(
				'csrf_key' => Application::getCSRFKey(),
				'news' => $news[0],
				'ads' => 0,
				'news_active_page' => 1,
				'ads_active_page' => 1,
				'first' => 0,
			));
		}

		public static function viewNews($request, $vars){
			$newsId = $vars['news_id'];
			$lang = Application::$storage['lang'];
			$news = NewsModel::getNews($newsId, $lang);

			$newsTmp = NewsModel::getLastNews(0, 1, $lang);
			$newsIds = array();
			foreach($newsTmp as $tmp){
				$newsIds[] = $tmp->r_id->value;
			}

			$active_page_key = array_search($newsId, $newsIds);
			$active_page = 1;
			if($active_page_key){
				$active_page = ceil(($active_page_key + 1)  / self::$limit);
			}

			if ($news) {
				self::renderTemplate('news' . ds . 'news.tpl', Array(
					'csrf_key' => Application::getCSRFKey(),
					'news' => $news,
					'ads' => 0,
					'news_active_page' => $active_page,
					'ads_active_page' => 1,
					'first' => 0,
				));
			} else ApplicationController::pageNotFound();
		}

		public static function viewAds($request, $vars){
			$adsId = $vars['ads_id'];
			$lang = Application::$storage['lang'];
			$ads = NewsModel::getNews($adsId, $lang);

			$adsTmp = NewsModel::getLastAds(0, 1, $lang);
			$adsIds = array();
			foreach($adsTmp as $tmp){
				$adsIds[] = $tmp->r_id->value;
			}

			$active_page_key = array_search($adsId, $adsIds);
			$active_page = 1;
			if($active_page_key){
				$active_page = ceil(($active_page_key + 1)  / self::$limit);
			}

			if ($ads) {
				self::renderTemplate('news' . ds . 'news.tpl', Array(
					'csrf_key' => Application::getCSRFKey(),
					'news' => 0,
					'ads' => $ads,
					'news_active_page' => 1,
					'ads_active_page' => $active_page,
					'first' => 1,
				));
			} else ApplicationController::pageNotFound();
		}

		public static function getNewsData($request, $vars) {
			if ($request->isAjax()) {
				$json = Array();
				$page = $_POST['pageId'];
				$lang = Application::$storage['lang'];

				$lastNews = NewsModel::getLastNews(self::$limit, $page, $lang);
				$json = array('newsData','newsPaginator');
				foreach($lastNews as $news){
					$temp = new stdClass();
					$temp->description = $news->description->value;
					$temp->date = $news->date->value;
					$temp->id = $news->r_id->value;
					$json['newsData'][] = $temp;
				}

				$newsCount = NewsModel::count(" WHERE `lang_id` = '{#1}' AND `type` = '0'", Array($lang));

				$newsPagesCount = ceil($newsCount / self::$limit);
				if($page > $newsPagesCount) $page = 1;
				$newsPaginator = Array();
				$newsPaginator = Utils::generatePaginator($newsCount, self::$limit, $page);
				$json['newsPaginator'] = $newsPaginator;

				echo json_encode($json);
			} else ApplicationController::pageNotFound($request, $vars);
		}


		public static function getAdsData($request, $vars) {
			if ($request->isAjax()) {
				$json = Array();
				$page = $_POST['pageId'];
				$lang = Application::$storage['lang'];

				$lastAds = NewsModel::getLastAds(self::$limit, $page, $lang);
				$json = array('adsData','adsPaginator');
				foreach($lastAds as $ads){
					$temp = new stdClass();
					$temp->description = $ads->description->value;
					$temp->date = $ads->date->value;
					$temp->id = $ads->r_id->value;
					$json['adsData'][] = $temp;
				}

				$adsCount = NewsModel::count(" WHERE `lang_id` = '{#1}' AND `type` = '1'", Array($lang));

				$adsPagesCount = ceil($adsCount / self::$limit);
				if($page > $adsPagesCount) $page = 1;
				$adsPaginator = Array();
				$adsPaginator = Utils::generatePaginator($adsCount, self::$limit, $page);
				$json['adsPaginator'] = $adsPaginator;

				echo json_encode($json);
			} else ApplicationController::pageNotFound($request, $vars);
		}

	}

?>