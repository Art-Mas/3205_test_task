<?php


namespace ThreeTwoZeroFive\Interfaces;


interface VideoInfoFactory
{
    /**
     * @param string $hostingName
     * @param string $fullUrl
     * @return VideoInfo|null
     */
    public function getVideoInfo(string $hostingName, string $fullUrl);

}