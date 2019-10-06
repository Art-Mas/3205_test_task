<?php


namespace ThreeTwoZeroFive\Classes;


class ResponseConfigurator
{
    public const RESPONSE_TYPE_JSON = 1;
    public const RESPONSE_TYPE_RAW = 2;

    private $reponseType = self::RESPONSE_TYPE_RAW;

    public function asJson()
    {
        $this->reponseType = self::RESPONSE_TYPE_JSON;
        return $this;
    }

    public function asRaw()
    {
        $this->reponseType = self::RESPONSE_TYPE_RAW;
        return $this;
    }

    public function configure()
    {
        return new ResponseConfig($this->reponseType);
    }

}