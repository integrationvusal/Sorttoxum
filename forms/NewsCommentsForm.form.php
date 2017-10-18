<?php

	class NewsCommentsForm extends Form {
	
		public $commentText;
		
		public static $enableCSRFSecurity = true;
		
		public function __construct() {
			$this->commentText = new FormTextField('commentText', FORM_VALIDATION_STRING);
			$this->commentText->minLength = 3;
		}
	
	}

?>