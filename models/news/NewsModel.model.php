<?php
	class NewsModel extends CRUDModel {
		public $r_id;
		public $lang_id;
		public $itemTitle;
		public $description;
		public $content;
		public $image;
		public $date;
		public $type;
		
		public static $tplViewFile;
		public static $multiLang = true;
		
		public function __construct() {
		
			$this->r_id = new stdClass();
			$this->r_id->value = null;
			$this->lang_id = new stdClass();
			$this->lang_id->value = null;
		
			$messages = Application::$messages['model_news'];
			$this->itemTitle = new ModelTextField("itemTitle", $messages['field_itemTitle'], true, true);
			$this->itemTitle->required = false;
			$this->description = new ModelTextArea("description", "Description", true, true);
			$this->description->required = false;
			$this->content = new ModelTinyMce("content", $messages['field_content'], true, true);
			$this->content->required = false;
			$this->image = new ModelFMImageField("image", "Image", false, true);
			$this->image->required = false;
			$this->image->common = true;
			$this->date = new ModelDateField("date", $messages['field_date'], true, true);
			$this->date->common = true;
			
			$this->type = new ModelSelectField("type", $messages['field_type'], Array(
				0 => "News",
				1 => "Ad"
			), true, true);
			$this->type->common = true;
		}
		
		public static function initialize() {
			self::$displayFields = Array('itemTitle', 'description', 'content', 'date', 'type');
			self::$title = "News";
			self::$iconPath = 'png/newspaper.png';
			self::$multiLang = true;
			self::$searchSettings = Array(
				'title_field' => 'itemTitle',
				'content_field' => 'content',
			);
			self::$searchable = true;
		}

		public function getSearchUrl() {
			if($this->type->value == 0) return 'news/' . $this->r_id->value;
			return 'ads/' . $this->r_id->value;
		}

		public static function getNews($newsId, $lang = false){
			if(!$lang) $lang = Application::$settings['default_language'];
			$news = NewsModel::get($newsId, $lang);
			return $news;
		}
		
		public static function getLastNews($count, $page = 1, $lang = false) {
			$page = intval($page);
			$offset = intval(($page - 1) * $count);
			if($offset < 0) $offset = 0;
			if(intval($count) == 0) $limit = "";
			else $limit = " LIMIT ". intval($count) . " OFFSET " . $offset;
			if(!$lang) $lang = Application::$storage['lang'];
			$sql = " WHERE ";
			$values = Array();
			$sql .= " `type` = '0'";
			if (self::$multiLang && $lang) {
				$sql .= " AND `lang_id` = '{#1}'";
				$values[] = $lang;
			}
			$sql .= "ORDER BY date DESC, r_id DESC" . $limit;

			$news = self::find($sql, $values);
			return $news;
		}

		public static function getLastAds($count, $page = 1, $lang = false) {
			$page = intval($page);
			$offset = intval(($page - 1) * $count);
			if($offset < 0) $offset = 0;
			if(intval($count) == 0) $limit = "";
			else $limit = " LIMIT ". intval($count) . " OFFSET " . $offset;
			if(!$lang) $lang = Application::$storage['lang'];
			$sql = " WHERE ";
			$values = Array();
			$sql .= " `type` = '1' ";
			if (self::$multiLang && $lang) {
				$sql .= " AND `lang_id` = '{#1}'";
				$values[] = $lang;
			}
			$sql .= "ORDER BY date DESC, r_id DESC" . $limit;

			$news = self::find($sql, $values);
			return $news;
		}
		

	}
?>