<?php

class LabelsModel extends CRUDModel{

    public $r_id;
    public $lang_id;
    public $label;
    public $key;
    public $category;

    public static $multiLang = true;

    public function __construct(){

        $this->r_id = new stdClass();
        $this->r_id->value = null;

        $this->lang_id = new stdClass();
        $this->lang_id->value = null;

        $this->label = new ModelTextField('label', Application::$labels['label_model']['label'], true, true);
        $this->label->required = false;

        $this->key = new ModelTextField('key', Application::$labels['label_model']['key'], true, true);
        $this->key->required = false;
        $this->key->common = true;

        $this->category = new ModelTextField('category', Application::$labels['label_model']['category'], true, true);
        $this->category->required = false;
        $this->category->common = true;

    }

    public static function initialize() {
        self::$displayFields = Array('label', 'key', 'category');
        self::$title = Application::$labels['label_model']['labels'];
        self::$iconPath = 'png/speech-bubbles.png';
        self::$multiLang = true;
    }

    public static function getLabels($lang = null, $category = null, $key = null){

        if($lang === null) $lang = Application::$settings['default_language'];

        $DB = self::getTableName();

        $sql = "";
        $labels = array();
        if($category != null && $key != null){
            $sql = "SELECT * FROM " . $DB . " WHERE `lang_id` = '{#1}' AND `category` = '{#2}' AND `key` = '{#3}'";
            $labels_raw = self::fQuery($sql, Array($lang, $category, $key));

            if(!empty($labels_raw)) return $labels_raw['label'];

        } elseif($category != null && $key == null) {
            $sql = "SELECT * FROM " . $DB . " WHERE `lang_id` = '{#1}' AND `category` = '{#2}'";
            $labels_raw = self::fQuery($sql, Array($lang, $category, $key));
            foreach($labels_raw as $label){
                $labels[$label['key']] = $label['label'];
            }

            return $labels;

        } else {
            $sql = "SELECT * FROM " . $DB . " WHERE `lang_id` = '{#1}'";
            $labels_raw = self::fQuery($sql, Array($lang, $category, $key));


            foreach($labels_raw as $label){
                $labels[$label['category']][$label['key']] = $label['label'];
            }


            return $labels;
        }

        return null;

    }

}