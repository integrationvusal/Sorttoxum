<?php

	class LostPswForm extends Form {
		
		public $email;
		
		public static $enableCSRFSecurity = true;
		
		public function __construct() {
			$this->email = new FormTextField('email', FORM_VALIDATION_EMAIL);
		}
		
	}

?>