<?php

namespace CPE\Framework;

class Route
{
    public string $url;
    public string $controller;
    public string $action;
    public string $method;
    public array $additional = [];
    public array $optional = [];
    public array $requestParams = [];

    public function __construct(string $url, string $controller, string $action = 'index',
                                string $method = 'GET', array $additional = [], array $optional = [])
    {
        $this->url = $url;
        $this->controller = $controller;
        $this->action = $action;
        $this->method = $method;
        $this->additional = $additional;
        $this->optional = $optional;
    }
}