<?php

class SliderModel extends CRUDModel{

    public $r_id;
    public $lang_id;
    public $image;
    public $image_alt;
    public $title_text;
    public $description;
    public $url;

    public static $multiLang = true;

    public function __construct() {

        $this->title_text = new ModelTextField("title_text", "Title", true, true);
        $this->title_text->common = true;
        $this->description = new ModelTextField("description", "Description", true, true);
        $this->description->common = true;
        $this->image = new ModelFMImageField("image", "Image", true, true);
        $this->image->common = true;
        $this->image_alt = new ModelTextField("image_alt", "Image alt", true, true);
        $this->image_alt->common = true;
        $this->url = new ModelTextField("url", "URL", false, false);
        $this->url->common = true;

    }

    public static function initialize() {
        self::$title = "Slider";
        self::$iconPath = 'png/smartphone-2.png';
        self::$displayFields = Array('image', 'image_alt', 'title_text', 'description', 'url');
        self::$multiLang = true;
    }

    public static function getSliderContent($lang = null){

        if($lang == null) $lang = Application::$settings['default_language'];
        $DB = self::getTableName();
        $query = "SELECT * FROM " . $DB . " WHERE `lang_id` = '{#1}'";

        return self::fQuery($query, array($lang));
    }

}