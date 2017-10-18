<?php

	class RestorePswForm extends Form {
	
		public $password1;
		public $password2;
		
		public static $enableCSRFSecurity = true;
		
		public function __construct() {
			$this->password1 = new FormPasswordField('password1', FORM_VALIDATION_STRING);
			$this->password1->title = Application::$storage['messages']['auth']['psw1'];
			
			$this->password2 = new FormPasswordField('password2', FORM_VALIDATION_STRING);
			$this->password2->title = Application::$storage['messages']['auth']['psw2'];
		}
	
	}

?>