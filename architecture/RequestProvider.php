<?php

interface RequestProvider
{
    public function request(string $url, string $methodRequest, array $options): mixed;
}