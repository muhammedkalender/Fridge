<?php

namespace Abstractions;

abstract class Drink
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    protected function setName(string $name)
    {
        $this->name = $name;
    }

    protected function getName(): string
    {
        return $this->name;
    }

    public abstract function getInfo();
}
