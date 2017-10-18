<?php

	class ModelFMImageField extends ModelField {
		
		// db synchronize settings
		public $dbType = 'varchar';
		public $dbLength = 150;
		// db synchronize settings end
	
        public function __construct($name, $title, $required, $multiLang, $common = false, $regExp = "/^.*/im") {
            parent::__construct($name, $title, $required, $multiLang, $common, $regExp);
             $this->skipSlashes = true;
        }

        public function  getHTML($lang = false) {
            return parent::generateHTML('imagefield.tpl', $this->value, $lang);
        }
		
		public function getSqlData($lang = false) {
            $value = $this->checkValueFromPost($lang);
            if ($value["success"]) {
				$startDir = Application::$settings['public_folder'];
				$value['value'] = str_replace($startDir, "", $value['value']);

				$this->setValue($value['value']);
                return Array(
                    "success" => true,
                    "name" => $value["name"],
                    "data" => $value["value"],
                );
            } else {
                return Array(
                    "success" => false,
					"name" => $value["name"],
                );
            }
        }
		public function getDisplayValue() {
			return '<img src="' . Application::$settings['url'] . '/imageresizer/resize/50/50/' . Application::$settings['public_folder'] . ds . $this->getValue() . '" />';
		}
    }

?>