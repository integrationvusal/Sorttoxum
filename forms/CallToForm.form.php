<?php

	class CallToForm extends Form {
	
		public $name;
		public $subject;
		public $time;
		public $number;
		
		public static $enableCSRFSecurity = true;
		public static $hasCaptcha = true;
		
		public function __construct() {
			$this->name = new FormTextField('name', FORM_VALIDATION_STRING);
			$this->name->minLength = 3;
			
			$this->subject = new FormTextField('subject', FORM_VALIDATION_STRING);
			$this->subject->minLength = 3;
			
			$this->time = new FormTextField('time', FORM_VALIDATION_STRING);
			$this->time->minLength = 3;
			
			$this->number = new FormTextField('number', FORM_VALIDATION_STRING);
			$this->number->minLength = 3;
			
		}
	
	}

?>