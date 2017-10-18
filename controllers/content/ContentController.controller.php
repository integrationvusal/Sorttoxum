<?php

	class ContentController extends Controller {

		public static function viewPage($request, $vars) {
			$pageId = $vars['page_id'];
			$lang = Application::$storage['lang'];

			if($pageId == 15 || self::checkIfHasInParents($pageId, 15, $lang)) {
				self::viewFealiyetPage($pageId, $lang);
				return;
			}

			$page = MenuModel::get($pageId, $lang);
			if ($page) {
				$childPages = MenuModel::getChildsForBoth($pageId, $lang);
				$haveChildPages = false;
				if (count($childPages)) $haveChildPages = true;
				if($haveChildPages){
					self::renderTemplate('content' . ds . 'view-page.tpl', Array(
						'page' => $page,
						'childPages' => $childPages,
						'currentPage' => $pageId,
						'csrf_key' => Application::getCSRFKey()
					));
					return;
				} else {
					if(self::checkIfHasInParents($pageId, 45, $lang) || self::checkIfHasInParents($pageId, 46, $lang)){
						self::viewRightBarPage($pageId, $lang);
						return;
					}
					$parentId = MenuModel::getParentFor($pageId, $lang);

					$parentOfParentId = 0;
					if($parentId) $parentOfParentId = MenuModel::getParentFor($parentId, $lang);
					if($parentId && $parentOfParentId){
						$page = MenuModel::get($parentId, $lang);
						$childPages = MenuModel::getChildsFor($parentId, $lang);
						self::renderTemplate('content' . ds . 'view-page.tpl', Array(
							'page' => $page,
							'childPages' => $childPages,
							'currentPage' => $pageId,
							'csrf_key' => Application::getCSRFKey()
						));
						return;
					} else {
						self::renderTemplate('content' . ds . 'view-page.tpl', Array(
							'page' => $page,
							'childPages' => array(),
							'currentPage' => $pageId,
							'csrf_key' => Application::getCSRFKey()
						));
						return;
					}
				}
			} else ApplicationController::pageNotFound($request);
		}

		public static function viewFealiyetPage($pageId, $lang){

			$currentPage = MenuModel::get($pageId, $lang);

			$firstLevel = MenuModel::get(15, $lang);
			$secondLevel = MenuModel::getChildsForBoth(15, $lang);
			$thirdLevel = array();
			foreach($secondLevel as $k=>$menuItem){
				$thirdLevel[$k] = MenuModel::getChildsForBoth($menuItem->r_id->value, $lang);
			}

			self::renderTemplate('content' . ds . 'view-page-fealiyet.tpl', Array(
				'page' => $currentPage,
				'firstLevel' => $firstLevel,
				'secondLevel' => $secondLevel,
				'thirdLevel' => $thirdLevel,
				'csrf_key' => Application::getCSRFKey()
			));

		}

		public static function viewRightBarPage($pageId, $lang){

			$page = MenuModel::get($pageId, $lang);
			self::renderTemplate('content' . ds . 'view-page.tpl', Array(
				'page' => $page,
				'childPages' => array(),
				'currentPage' => $pageId,
				'csrf_key' => Application::getCSRFKey()
			));

		}

		private static function checkIfHasInParents($pageId, $searchId, $lang){

			$parent = MenuModel::getParentForNew($pageId, $lang);
			while($parent){
				if($parent == $searchId)
					return true;
				else
					$parent = MenuModel::getParentByTreeItemId($parent, $lang);
			}
			return false;

		}
		
	}

?>