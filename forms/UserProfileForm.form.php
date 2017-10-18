<?php

	class UserProfileForm extends Form {
		
		public $name;
		public $surName;
		public $password;
		public $sex;
		public $birthDay;
		public $interests;
		public $phone;
		
		public static $enableCSRFSecurity = true;
		
		public function __construct() {
		
			$this->name = new FormTextField('name', FORM_VALIDATION_STRING);
			$this->name->minLength = 2;
			$this->name->required = false;
			
			$this->surName = new FormTextField('surName', FORM_VALIDATION_STRING);
			$this->surName->minLength = 3;
			$this->surName->required = false;
			
			$this->phone = new FormTextField('phone', FORM_VALIDATION_STRING);
			$this->phone->minLength = 3;
			$this->phone->required = false;
			
			$this->password = new FormTextField('password', FORM_VALIDATION_STRING);
			$this->password->minLength = 6;
			$this->password->required = false;
			
			$this->sex = new FormSelectField('sex', 0, Array());
			$this->sex->required = false;
			
			$this->birthDay = new FormTextField('birthDay', FORM_VALIDATION_STRING);
			$this->birthDay->minLength = 5;
			$this->birthDay->required = false;
			
			$this->interests = new FormCheckBoxField('interests');
			$this->interests->required = false;
		
		}
		
	}

?>