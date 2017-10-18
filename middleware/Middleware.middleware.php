<?php

    class Middleware extends Controller {
		
		public static function initializeApp($request, $vars = Array()) {
			AuthController::checkCookie();
			AuthController::checkGuest();
			$loggedIn = AuthController::checkLoggedIn();
			self::$smarty->assign('logged_in', $loggedIn);
			
			$lang = self::getCurrentLang($vars);
			Application::$storage['lang'] = $lang;
			
			Application::$storage['messages'] = self::parseLangFile($lang, true);
			Application::$storage['labels'] = self::getLangLabels($lang, true);

			self::getSliderContents();
		}
		
        /* for assigning vars for template */
        public static function forSmarty($request, $vars = Array()) {
            self::$smarty->assign('static_url', Application::$settings['static_url']);
			self::$smarty->assign('app_url', Application::$settings['url']);
			self::$smarty->assign('public_url', Application::$settings['public_url']);
			self::$smarty->assign('request_url', Application::$settings['url'] . '/' . Controller::$request);
			self::$smarty->assign('session_name', session_name());
			self::$smarty->assign('session_id', session_id());
        }
		
		public static function getLangsUrl($request, $vars = Array()) {
			$currentLang = Application::$storage['lang'];
			$langUrls = Array();
			$languages = Application::$settings['languages'];
			$url = Controller::$request;
			$urlData = explode("/", $url);
			unset($urlData[0]);
			
			self::$smarty->assign('langUrl', join('/', $urlData));
			self::$smarty->assign('languages', $languages);
			self::$smarty->assign('currentLang', $currentLang);
			return;
		}
		
		public static function getMenu($request, $vars = Array()) {
			$curLang = Application::$storage['lang'];
			$menuTreeItems = MenuModel::getTreeItems();

			$menuModelItems = MenuModel::getAllRecords($curLang, 'treeItemId', false);
			$c = count($menuModelItems);
			foreach ($menuModelItems as $k => $mItem) {
				switch ($mItem->type->value) {
					case 1:
						$menuModelItems[$k]->url = Application::$settings['url'] . '/' . Application::$storage['lang'] . '/' . 'view-page/' . $mItem->r_id->value . '/' . urlencode($mItem->menuItemTitle->value);
						break;
					case 2:
						$model = Application::$modules[Application::$adminName]['models'][$mItem->modelId->value];
						$model::initialize();
						$menuModelItems[$k]->url = Application::$settings['url'] . '/' . Application::$storage['lang'] . '/' . $model::$viewUrl;
						break;
					case 3:
						$menuModelItems[$k]->url = Application::$settings['url'] . "/" . Application::$storage['lang'] . "/" . $mItem->link->value;
						break;
					case 4:
						$menuModelItems[$k]->url = Application::$settings['url'] . '/' . Application::$storage['lang'] . '/' . 'view-page/' . $mItem->pageId->value;
						break;
				}

				switch($mItem->class->value){
					case 0: $mItem->class->value = ""; break;
					case 1: $mItem->class->value = "no-sub"; break;
					case 2: $mItem->class->value = "full-width"; break;
					case 3: $mItem->class->value = "right-aligned"; break;
					default: $mItem->class->value = ""; break;
				}
			}

			self::$smarty->assign('menuTreeItems', $menuTreeItems);
			self::$smarty->assign('menuModelItems', $menuModelItems);
		}
		
		private static function getCurrentLang($vars) {
			return (isset($vars['lang']) && in_array($vars['lang'], array_keys(Application::$settings['languages']))) ? $vars['lang'] : Application::$settings['default_language'];
		}
    }

?>