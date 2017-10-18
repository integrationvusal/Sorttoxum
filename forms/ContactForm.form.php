<?php

	class ContactForm extends Form {
		
		public $name;
		public $email;
		public $phone;
		public $topic;
		public $content;

		public static $hasCaptcha = true;
		public static $enableCSRFSecurity = false;
		
		public function __construct() {

			$this->name = new FormTextField('name', FORM_VALIDATION_STRING);
			$this->name->minLength = 3;
			
			$this->email = new FormTextField('email', FORM_VALIDATION_EMAIL);
			$this->email->minLength = 5;

			$this->phone = new FormTextField('phone', FORM_VALIDATION_STRING);
			$this->phone->minLength = 7;
			
			$this->topic = new FormTextField('topic', FORM_VALIDATION_STRING);
			$this->topic->minLength = 3;

			$this->content = new FormTextField('content', FORM_VALIDATION_STRING);
			$this->content->minLength = 3;
		}
		
	}

?>