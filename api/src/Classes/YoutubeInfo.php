<?php


namespace ThreeTwoZeroFive\Classes;


use Curl\Curl;
use ThreeTwoZeroFive\Interfaces\VideoInfo;

class YoutubeInfo implements VideoInfo
{
    private $url = '';
    private const VIDEO_ID_REGEX = '#youtube\.com\/watch\?v\=([a-zA-Z0-9-_]{11})$#';
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function fetchData(): array
    {
        if (!preg_match(self::VIDEO_ID_REGEX, $this->url, $matches)) {
            throw new FetchVideoException('Invalid video ID');
        }

        $curl = new Curl();
        $curl->get('http://www.youtube.com/oembed', [
            'url' => $this->url,
            'format' => 'json'
        ]);
        if ($curl->error) {
            $errorMessage = $curl->errorMessage;
            if ($curl->errorCode === 404) {
                $errorMessage = 'No video found on this link';
            }
            throw new FetchVideoException($errorMessage);
        }
        return array_merge((array)$curl->response, ['provider' => 'youtube']) ;
    }
}