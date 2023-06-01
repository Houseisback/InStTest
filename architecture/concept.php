<?php

class Concept
{
    private TokenStoreInterface $tokenStore;

    private $client;

    public function __construct(TokenStoreInterface $tokenStore, Client $client)
    {
        $this->tokenStore = $tokenStore;
        $this->client = $client;
    }

    public function setTokenStore(TokenStoreInterface $tokenStore)
    {
        $this->tokenStore = $tokenStore;
    }

    public function storeToken(string $token)
    {
        $this->tokenStore->storeToken($token);
    }

    public function getUserData()
    {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->tokenStore->getToken()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }
}