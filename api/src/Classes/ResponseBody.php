<?php


namespace ThreeTwoZeroFive\Classes;


class ResponseBody
{
    /**
     * @var ResponseConfig
     */
    private $config;

    private $body;

    public function __construct(ResponseConfig $config)
    {
        $this->config = $config;
    }

    private function defineBody() {
        if ($this->body === null) {
            if ($this->config->isRaw()) {
                $this->body = '';
            } elseif ($this->config->isJson()) {
                $this->body = [];
            }
        }
    }

    private function contentToString($content) {
        $result = $content;
        if (is_array($content)) {
            $result =  implode(' ', $content);
        }
        return $result;
    }

    public function add($content)
    {
        $this->defineBody();
        if ($this->config->isJson()) {
            $this->body = array_merge($this->body, $content);
        } elseif ($this->config->isRaw()) {
            $this->body += $this->contentToString($content);
        }
    }

    public function addError($errorText)
    {
        $error = 'Error: ' . $errorText;
        if ($this->config->isJson()) {
            if (!isset($this->body['errors'])) {
                $this->body['errors'] = [];
            }
            $this->body['errors'][] = $errorText;
        } elseif ($this->config->isRaw()) {
            $this->add($error);
        }
    }

    public function get()
    {
        if ($this->config->isJson()) {
            header('Content-Type: application/json');
            return json_encode((object)$this->body, JSON_UNESCAPED_UNICODE);
        }
        return $this->body;

    }

}