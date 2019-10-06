<?php

namespace ThreeTwoZeroFive\Classes;

use ThreeTwoZeroFive\Interfaces\VideoInfo;

class VideoInfoFactory implements \ThreeTwoZeroFive\Interfaces\VideoInfoFactory {

    /**
     * @param string $hostingName
     * @param string $fullUrl
     * @return VideoInfo|null
     */
    public function getVideoInfo(string $hostingName, string $fullUrl)
    {
        $result = null;
        switch ($hostingName) {
            case 'youtube.com':
                $result = new YoutubeInfo($fullUrl);
                break;
            case 'rutube.ru':
                $result = new RutubeInfo($fullUrl);
                break;
        }

        return $result;
    }
}