<?php

class GalleryController extends Controller{

    public static $limit = 4;

    public static function viewPhotos($request, $vars){

        $page = $vars['page_id'];
        $photos = PhotoModel::getPhotos($page, self::$limit);

        $photosCount = PhotoModel::count();

        $photosPagesCount = ceil($photosCount / self::$limit);
        if($page > $photosPagesCount) $page = 1;
        $photosPaginator = Array();
        $photosPaginator = Utils::generatePaginator($photosCount, self::$limit, $page);

        self::renderTemplate("gallery" . ds . "foto.tpl", array(
            'photos' => $photos,
            'paginator' => $photosPaginator,
            'activePage' => $page
        ));

    }

    public static function viewPhoto($request, $vars){
        $photoId = $vars['photo_id'];

        $photosTmp = PhotoModel::getPhotos(1, 0);
        $photosIds = array();
        foreach($photosTmp as $tmp){
            $photosIds[] = $tmp->id->value;
        }

        $active_page_key = array_search($photoId, $photosIds);
        $page = 1;
        if($active_page_key !== false){
            $page = ceil(($active_page_key + 1)  / self::$limit);

            $photos = PhotoModel::getPhotos($page, self::$limit);

            $photosCount = PhotoModel::count();

            $photosPagesCount = ceil($photosCount / self::$limit);
            if($page > $photosPagesCount) $page = 1;
            $photosPaginator = Array();
            $photosPaginator = Utils::generatePaginator($photosCount, self::$limit, $page);

            self::renderTemplate("gallery" . ds . "foto.tpl", array(
                'photos' => $photos,
                'paginator' => $photosPaginator,
                'activePage' => $page,
                'photoId' => $photoId
            ));
        } else {
            ApplicationController::pageNotFound();
        }
    }

    public static function viewVideos($request, $vars){
        $page = $vars['page_id'];
        $videos = VideoModel::getVideos($page, self::$limit);

        $videosCount = VideoModel::count();

        $videosPagesCount = ceil($videosCount / self::$limit);
        if($page > $videosPagesCount) $page = 1;
        $videosPaginator = Array();
        $videosPaginator = Utils::generatePaginator($videosCount, self::$limit, $page);

        /*
        echo "<pre>";
        print_r($photos);
        echo "</pre>";
        */
        self::renderTemplate("gallery" . ds . "video.tpl", array(
            'videos' => $videos,
            'paginator' => $videosPaginator,
            'activePage' => $page
        ));
    }

    public static function viewVideo($request, $vars){
        $videoId = $vars['video_id'];

        $videosTmp = VideoModel::getVideos(1, 0);
        $videosIds = array();
        foreach($videosTmp as $tmp){
            $videosIds[] = $tmp->id->value;
        }

        $active_page_key = array_search($videoId, $videosIds);
        $page = 1;
        if($active_page_key !== false){
            $page = ceil(($active_page_key + 1)  / self::$limit);

            $videos = VideoModel::getVideos($page, self::$limit);

            $videosCount = VideoModel::count();

            $videoPagesCount = ceil($videosCount / self::$limit);
            if($page > $videoPagesCount) $page = 1;
            $videosPaginator = Array();
            $videosPaginator = Utils::generatePaginator($videosCount, self::$limit, $page);

            self::renderTemplate("gallery" . ds . "video.tpl", array(
                'videos' => $videos,
                'paginator' => $videosPaginator,
                'activePage' => $page,
                'videoId' => $videoId
            ));
        } else {
            ApplicationController::pageNotFound();
        }
    }

}