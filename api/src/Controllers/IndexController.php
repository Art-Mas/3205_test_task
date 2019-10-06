<?php


namespace ThreeTwoZeroFive\Controllers;


use ThreeTwoZeroFive\Classes\Controller;
use ThreeTwoZeroFive\Classes\FetchVideoException;
use ThreeTwoZeroFive\Classes\ResponseBody;
use ThreeTwoZeroFive\Classes\ResponseConfig;
use ThreeTwoZeroFive\Classes\ResponseConfigurator;
use ThreeTwoZeroFive\Classes\VideoInfoFactory;

class IndexController extends Controller
{
    public function actionView($vars)
    {
        $url = $_GET['v'] ?? '';
        // check is correct url and fetch it hosting name with zone
        // eg: www.youtube.com/... => youtube.com
        $isCorrectUrl = preg_match('#https?:\/\/(www\.)?(.+\.\w{1,10}).*#i', $url, $matches);
        $body = new ResponseBody((new ResponseConfigurator())->asJson()->configure());
        if ($isCorrectUrl) {
            $videoInfoFactory = new VideoInfoFactory();
            $hostingName= $matches[2];
            $videoInfo = $videoInfoFactory->getVideoInfo($hostingName, $url);
            if ($videoInfo) {
                try {
                    $result = $videoInfo->fetchData();
                    $body->add($result);
                } catch (FetchVideoException $exception) {
                    $body->addError($exception->getMessage());
                }
            } else {
                $body->addError('This video hosting is not supported');
            }
        } else {
            $body->addError('Invalid url');
        }

        return $body;
    }
}