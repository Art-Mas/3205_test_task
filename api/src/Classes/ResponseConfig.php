<?php


namespace ThreeTwoZeroFive\Classes;


class ResponseConfig
{
    private $responseType;

    public function __construct($responseType)
    {
        $this->responseType = $responseType;
    }

    public function isJson()
    {
        return ResponseConfigurator::RESPONSE_TYPE_JSON === $this->responseType;
    }

    public function isRaw()
    {
        return ResponseConfigurator::RESPONSE_TYPE_RAW === $this->responseType;
    }

}