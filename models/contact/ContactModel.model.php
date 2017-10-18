<?php

class ContactModel extends CRUDModel {

    public $name;
    public $email;
    public $phone;
    public $topic;
    public $content;
    public $answered;
    public $date;


    //public $address;

    public function __construct() {
        $messages = Application::$messages['model_feedback'];
        $commonMessages = Application::$messages['common_messages'];

        $this->name = new ModelTextField("name", "Name", true, false);

        $this->email = new ModelTextField("email", "Email", true, false);

        $this->phone = new ModelTextField("phone", "Phone", true, false);

        $this->topic = new ModelTextField("topic", "Topic", true, false);

        $this->content = new ModelTextArea("content", "Content", true, false);

        $this->date = new ModelDateField("date", "Date", true, false);

        $this->answered = new ModelSelectField("answered", "Answered", Array(
            0 => "NO",
            1 => "YES"
        ), true, false);
    }

    public static function initialize() {
        self::$displayFields = Array('name', 'email', 'phone', 'topic', 'answered');
        self::$title = "Contact form";
        self::$iconPath = 'png/letter-1.png';
        self::$multiLang = false;
    }

}

?>