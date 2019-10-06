<?php


namespace ThreeTwoZeroFive\Classes;


use ThreeTwoZeroFive\Interfaces\VideoInfo;

class RutubeInfo implements VideoInfo
{
    public function __construct(string $url)
    {
    }

    public function fetchData(): array
    {
        return ['provider' => 'rutube'];
    }

}