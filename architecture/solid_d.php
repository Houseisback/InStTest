<?php

class XMLHttpService implements RequestProvider
{
    public function request(string $url, string $methodRequest, array $options): mixed
    {
        // TODO: Implement request() method.
    }
}

class Http
{
    private $requestProvider;

    public function __construct(RequestProvider $requestProvider)
    {
        $this->requestProvider = $requestProvider;
    }

    public function get(string $url, array $options)
    {
        $this->requestProvider->request($url, 'GET', $options);
    }

    public function post(string $url, array $options)
    {
        $this->requestProvider->request($url, 'post', $options);
    }
}
