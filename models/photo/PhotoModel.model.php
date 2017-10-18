<?php

class PhotoModel extends CRUDModel{

    public $id;
    public $thumb;
    public $image;
    public $name;
    public $description;

    public function __construct(){

        $this->thumb = new ModelFMImageField('thumb', 'Thumb', true, false);
        $this->image = new ModelFMImageField('image', 'Image', true, false);

        $this->name = new ModelTextField("name", "Name in gallery", false, false);
        $this->description = new ModelTextArea("description", "Description", false, false);

        $this->date = new ModelDateField("date", "Date", true, false);

    }

    public static function initialize() {
        self::$displayFields = Array('thumb', 'image', 'name', 'description', 'date');
        self::$title = "Photo";
        self::$iconPath = 'png/videocall.png';
        self::$useOwnViewUrl = false;
    }

    public static function getPhoto($photoId){
        $photo = PhotoModel::get($photoId);
        return $photo;
    }

    public static function getPhotos($page, $count = 1){
        $page = intval($page);
        $offset = intval(($page - 1) * $count);
        if($offset < 0) $offset = 0;
        if(intval($count) == 0) $limit = "";
        else $limit = " LIMIT ". intval($count) . " OFFSET " . $offset;
        $sql = " ORDER BY `date` DESC" . $limit;

        $photos = self::find($sql);
        return $photos;
    }

}