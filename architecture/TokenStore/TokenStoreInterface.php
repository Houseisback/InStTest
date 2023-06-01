<?php

interface TokenStoreInterface
{
    public function storeToken(string $token);

    public function getToken(): string;
}