<?php

class VideoModel extends CRUDModel{

    public $id;
    public $thumb;
    public $video_url;
    public $name;
    public $description;

    public function __construct(){

        $this->thumb = new ModelFMImageField('thumb', 'Thumb', true, false);
        $this->video_url = new ModelTextField('video_url', 'Video URL', true, false);

        $this->name = new ModelTextField("name", "Name in gallery", false, false);
        $this->description = new ModelTextArea("description", "Description", false, false);

        $this->date = new ModelDateField("date", "Date", true, false);

    }

    public static function initialize() {
        self::$displayFields = Array('thumb', 'video_url', 'name', 'description', 'date');
        self::$title = "Video";
        self::$iconPath = 'png/megaphone-1.png';
        self::$useOwnViewUrl = false;
    }

    public static function getVideo($videoId){
        $video = VideoModel::get($videoId);
        return $video;
    }

    public static function getVideos($page, $count = 1){
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