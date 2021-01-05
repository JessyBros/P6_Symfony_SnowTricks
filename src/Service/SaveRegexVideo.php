<?php

namespace App\Service;

class SaveRegexVideo{

    const URL_YOUTUBE = "/".
                        "^https:\/\/www.youtube.com\/watch\?v="
                . "|" . "^https:\/\/youtu\.be\/"
                . "|" . "^https:\/\/youtube\.com\/embed\/"
                        ."/";

    const URL_DAILYMOTION = "/".
                            "^https:\/\/dai\.ly\/"
                    . "|" . "^https:\/\/dailymotion\.com\/embed\/video\/"
                            ."/";

    public function save($video) {
        $url = $video->get('path')->getData();
        if ($url != null) {
            switch ($url) {
                case (preg_match(self::URL_YOUTUBE, $url, $urlCut)? true : false):
                        $urlValid = str_replace($urlCut,"https://youtube.com/embed/",$url);
                    break;
                case (preg_match(self::URL_DAILYMOTION, $url, $urlCut)? true : false):
                        $urlValid = str_replace($urlCut,"https://dailymotion.com/embed/video/",$url);
                    break;
            }
            $video->getData()->setPath($urlValid);
        }
    }
}