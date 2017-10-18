<?php

class Logger{

    public static function writeNewLog($fileName, $content){

        $mainPath = $_SERVER['DOCUMENT_ROOT'] . "/toxumculuq/log";

        file_put_contents($mainPath . "/" . $fileName, $content);

    }

    public static function log($content){

        $path = $_SERVER['DOCUMENT_ROOT'] . "/toxumculuq/log/log.txt";

        $date = date("Y-m-d H:i:s");

        file_put_contents($path, $date . " - " . $content . "\n", FILE_APPEND);

    }

}