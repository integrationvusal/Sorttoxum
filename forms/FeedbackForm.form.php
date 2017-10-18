<?php

	class FeedbackForm extends Form {
		
		public $name;
		//public $address;
		public $email;
		public $text;


		public static $enableCSRFSecurity = true;
		
		public function __construct() {

			$this->name = new FormTextField('name', FORM_VALIDATION_STRING);
			$this->name->minLength = 3;
			
			$this->address = new FormTextField('address', FORM_VALIDATION_STRING);
			$this->address->minLength = 3;
			
			$this->email = new FormTextField('email', FORM_VALIDATION_EMAIL);
			$this->email->minLength = 5;
			
			$this->text = new FormTextField('text', FORM_VALIDATION_STRING);
			$this->text->minLength = 3;
		}
		
	}

?>