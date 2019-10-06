<?php


namespace ThreeTwoZeroFive\Interfaces;


interface VideoInfo
{
    public function __construct(string $url);
    public function fetchData(): array;

}