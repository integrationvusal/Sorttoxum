<?php

	class LoginForm extends Form {
	
		public $email;
		public $password;
		
		public static $enableCSRFSecurity = true;
		
		public function __construct() {
			$this->email = new FormTextField('email', FORM_VALIDATION_EMAIL);
			$this->password = new FormTextField('password', FORM_VALIDATION_STRING);
			$this->password->minLength = 2;
		}
	}

?>