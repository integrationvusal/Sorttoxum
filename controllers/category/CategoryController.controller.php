<?php

	class CategoryController extends Controller {
	
		public static function getList($request, $vars) {
			
			$page = $vars['page_number'];
			$limit = 9;
			$start = $page * $limit;
			
			$categories = CategoryModel::getOnlyLastCategories(0, 'itemTitle', Application::$storage['lang'], false, $start, $limit);
			foreach ($categories as $k => $v) {
				$categories[$k]->objCount = ObjectsModel::count(" WHERE `type` <> '2' AND `category` = '" . $categories[$k]->id->value . "' AND `lang_id` = '".Application::$storage['lang']."'");
			}
			
			$count = count(CategoryModel::getOnlyLastCategories(0, 'itemTitle', Application::$storage['lang'], true));
			
			$paginator = Utils::generatePaginator($count, $limit, $page);
			
			self::renderTemplate('category' . ds . 'category-list.tpl', Array(
				'categories' => $categories,
				'paginator' => $paginator,
				'csrf_key' => Application::getCSRFKey(),
				'currentPage' => $page
			));
			
		}
		
		public static function view($request, $vars) {
			$categoryId = $vars['category_id'];
			$lang = Application::$storage['lang'];
			
			$category = CategoryModel::find(" WHERE `id` = '{#1}'", Array($categoryId));
			
			if ($category) {
				$page = $vars['page_number'];
				$limit = 5;
				$start = $page * $limit;
				$objCount = ObjectsModel::getObjectsCount($categoryId, $lang);
				
				
				$objects = ObjectsModel::getObjectsForCategory($categoryId, $lang, $start, $limit);
				
				$c = count($objects);
				$newObjects = Array();
				for ($i = 0; $i < $c; $i++) {
					$newObjects[$i]['parent'] = $objects[$i];
					if ($objects[$i]['type'] == '1') {
						$childs = ObjectsModel::getDataFor($objects[$i]['elId'], $lang);
						$cCount = count($childs);
						for ($j = 0; $j < $cCount; $j++) {
							$childs[$j]['phone'] = join("<br/>", explode(",", $childs[$j]['phone']));
						}
						$newObjects[$i]['childs'][] = $childs;
					}
				}
				
				$paginator = Utils::generatePaginator($objCount, $limit, $page);
				
				
				
				self::renderTemplate('category' . ds . 'category-view.tpl', Array(
					'category' => $category[0],
					'objects' => $newObjects,
					'csrf_key' => Application::getCSRFKey(),
					'paginator' => $paginator,
					'currentPage' => $page
				));
			} else ApplicationController::pageNotFound();
		}
	
	}

?>