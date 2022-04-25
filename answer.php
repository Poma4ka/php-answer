<?php

namespace zcl;


class answer
{

    public static function new() :answer
    {
        return new answer();
    }

    private function __construct(){}

    private int $code = 200;
    private bool $success = true;
    private array|string|int|float|null $data = null;
    private array $headers = ["Content-Type: application/json"];

    private ?array $meta = null;
    private ?string $error = null;

    private function setHeaders()
    {
        foreach ($this->headers as $header) {
            header($header);
        }
    }

    public function send() :void
    {
        $this->setHeaders();

        $result = [];

        $result["code"] = $this->code;
        $result["success"] = $this->success;
        if ($this->data !== null) $result["data"] = $this->data;
        if ($this->meta !== null) $result["meta"] = $this->meta;
        if ($this->error !== null) $result["error"] = $this->error;

        die(json_encode($result,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    }

    public function file($path) :answer
    {
        if (file_exists($path)) {
            $contentType = mime_content_type($path);
            header("Content-type: $contentType");
            die(file_get_contents($path));
        }
        return $this;
    }

    public function code(int $code) : answer
    {
        $this->code = $code;
        return $this;
    }

    public function data(array|string|int|float|null $data) : answer
    {
        $this->data = $data;
        return $this;
    }

    public function success() : answer
    {
        $this->success = true;
        return $this;
    }

    public function error(string $error = null) : answer
    {
        if ($error) {
            $this->error = $error;
        }
        $this->success = false;
        return $this;
    }

    public function meta(array $meta) : answer
    {
        $this->meta = $meta;
        return $this;
    }

    public function headers(string ...$headers) : answer
    {
        foreach ($headers as $header) {
            if (!in_array($header,$this->headers)) {
                $this->headers[] = $header;
            }
        }
        return $this;
    }

    public function cookie(string $name,string $value = "",int $validity = 0,string $path = "/",string $domain = "",bool $ssl = false) : answer
    {
        setcookie($name,$value,time() + $validity,$path,$domain,$ssl);
        return $this;
    }
    
    public function location($location) : ?answer
    {
        if ($_SERVER['REQUEST_URI'] !== $location) {
            $this->headers("Location: $location");
            $this->send();
        }
        return $this;
    }
}
