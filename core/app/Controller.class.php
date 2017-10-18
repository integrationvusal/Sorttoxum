<?php
    abstract class Controller {

        public static $smarty;
        public static $request;
        public static $currentLang;
		public static $_app;

        public static function initialize() {
        Global $__app;
        Global $__template;
            self::$smarty = new Smarty();
            self::$smarty->setTemplateDir($__app["templates_folder"])->addTemplateDir(core_path . ds . 'views');
            self::$smarty->error_reporting = E_ALL & ~E_NOTICE;
            //self::$smarty->caching = 1;
            //self::$smarty->debugging = $__template["debug"];
			
			$r = urldecode($_SERVER['REQUEST_URI']);
			
            // request
            // from http://wmforum.net.ru/lofiversion/index.php/t87073.html
            $__request = preg_replace("/^(.*?)index\.php$/is", "$1", $_SERVER['SCRIPT_NAME']);
            $__request = preg_replace("/^".preg_quote($__request, "/")."/is", "", urldecode($r));
            //$__request = preg_replace("/(\/?)(\?.*)?$/is", "", $__request);
            //$__request = preg_replace("/[^0-9A-Za-zа-яА-Яəöğşçü._\\-\\/]/is", "|", $__request);
            $__request = explode("/", $__request);
            //if (preg_match("/^index\.(?:html|php)$/is", $__request[0])) unset($__request[0]);
            //if (preg_match("/^index\.(?:html|php)$/is", $__request[count($__request) - 1])) unset($__request[count($__request) - 1])//;
            self::$request = join($__request, "/");

			self::$_app = $__app;
			
        }

        public static function redirect($class, $controller, $request, $vars = Array()) {
            $rM = new ReflectionMethod($class, $controller);
            $rM->invoke(null, $request, $vars);
        }

        public static function render() {

        }

        public static function renderTemplate($templateName, $vars = Array(), $fetch = false) {
            foreach (self::$smarty->getTemplateDir() as $dir) {
				if (is_file($dir . $templateName)) {
					foreach ($vars as $k => $v) self::$smarty->assign($k, $v);
					if (!$fetch) self::$smarty->display($templateName);
					else return self::$smarty->fetch($templateName);
				}
			}
			return false;
        }

        public static function parseLangFile($lang, $return = false, $folder = "", $module = false) {
		Global $__modules;
            $file = ($module) ? $__modules[$module]["messages_folder"] . ds . $folder . ds . $lang . ".ini" : self::$_app["language_file_folder"] . ds . $folder . ds . $lang . ".ini";
            $messages = parse_ini_file($file, true);
			self::$smarty->assign("messages",$messages);
            if ($return) return $messages;
        }

        public static function getLangLabels($lang = null, $return = false, $category = null, $key = null){

            $labels = LabelsModel::getLabels($lang, $category, $key);
            self::$smarty->assign("labels",$labels);
            if ($return) return $labels;

        }

        public static function getSliderContents($lang = null){
            $contents = SliderModel::getSliderContent($lang);
            self::$smarty->assign("slider", $contents);

            return $contents;
        }

    }
?>