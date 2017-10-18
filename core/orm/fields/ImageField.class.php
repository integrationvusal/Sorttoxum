<?php

	class ModelImageField extends ModelFileField {
        public $resizeOptions = Array();
        public $deleteOriginal;
        public $title;
		
        public function __construct($name, $title, $uploadFolder, $multiLang = false, $common = false, $required = true, $allowedExtensions = Array(), $maxFileSize = 2000000, $required = true, $deleteOriginal = false) {
            parent::__construct($name, $title, $uploadFolder, $multiLang, $common, $required, $allowedExtensions, $maxFileSize);
            $this->deleteOriginal = $deleteOriginal;
            $this->skipSlashes = true;
        }

        protected function generateFileName($inputFileName) {
            $fileName = md5(date('Y-m-d H:i:s') . rand(1,10000));
            $fileDest = "";
            for ($i = 0; $i < 3; $i++) {
                $fileDest = $fileDest . ds . substr($fileName,$i,1);
                $count = count($this->resizeOptions);
                for ($j = 0; $j < $count; $j++) {
                    if (!is_dir($this->uploadFolder . $this->resizeOptions[$j][0] . $fileDest)) {
                        mkdir($this->uploadFolder . ds . $this->resizeOptions[$j][0] . $fileDest, 0777);
                    }
                }
                if (!is_dir($this->uploadFolder . $fileDest)) mkdir($this->uploadFolder . $fileDest);
            }
            return $fileDest . ds . $fileName . strrchr($inputFileName,'.');
        }

		protected function deleteOldFile($lang = false) {
			$name = "delete-old";
			$fileName = "";
			if ($this->multiLang) {
				if (isset($_POST['delete-old'][$lang])) {
					$fileName = $this->getOldFileName($lang);
				}
			} else {
				if (isset($_POST['delete-old'])) {
					$fileName = $this->getOldFileName($lang);
				}
			}
			if ($fileName) unlink($this->uploadFolder . $fileName);
			$count = count($this->resizeOptions);
			for ($i = 0; $i < $count; $i++) {
				if (file_exists($this->uploadFolder . ds . $this->resizeOptions[$i][0] . $fileName))
				unlink($this->uploadFolder . ds . $this->resizeOptions[$i][0] . $fileName);
			}
		}

        protected function upload($from, $to) {
            require_once app_root . ds . "libs" . ds . "phpthumb" . ds . "ThumbLib.inc.php";
            $tmpUploadFile = $this->uploadFolder . $to;
            move_uploaded_file($from, $tmpUploadFile);
            $count = count($this->resizeOptions);
            for ($i = 0; $i < $count; $i++) {
                $phpthumb = PhpThumbFactory::create($tmpUploadFile);
                $phpthumb->resize($this->resizeOptions[$i][1], $this->resizeOptions[$i][2]);
                $phpthumb->save($this->uploadFolder . ds . $this->resizeOptions[$i][0] . $to);
                unset($phpthumb);
            }
            if ($this->deleteOriginal) unlink($tmpUploadFile); 
        }
    }

?>