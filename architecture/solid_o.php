<?php

class SomeObject
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getObjectName(): string
    {
        return $this->name;
    }
}

class SomeObjectsHandler
{
    private const HANDLE = 'handle_';

    public function __construct()
    {
    }

    public function handleObjects(array $objects, array $handlers): array
    {
        foreach ($objects as $object) {
            $handlers[] = self::HANDLE . $object->getObjectName();
        }

        return $handlers;
    }
}

$objects = [
    new SomeObject('object_1'),
    new SomeObject('object_2')
];

$soh = new SomeObjectsHandler();

$soh->handleObjects($objects, []);