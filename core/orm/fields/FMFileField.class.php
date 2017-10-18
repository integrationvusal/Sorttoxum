<?php

	class ModelFMFileField extends ModelField {
        public $maxLength = 255;
		public $valueType = 'VARCHAR';
		
		// db synchronize settings
		public $dbType = 'varchar';
		// db synchronize settings end
	
        public function __construct($name, $title, $required, $multiLang, $common = false, $regExp = "/^.*/im") {
            parent::__construct($name, $title, $required, $multiLang, $common, $regExp);
            $this->skipSlashes = true;
        }

        public function  getHTML($lang = false) {
            return parent::generateHTML('filefield.tpl', $this->value, $lang);
        }
		
		public function getSqlData($lang = false) {
            $value = $this->checkValueFromPost($lang);
			
			$startDir = Application::$settings['public_folder'];
			$value['value'] = str_replace($startDir, "", $value['value']);
            if ($value["success"]) {
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
    }

?>