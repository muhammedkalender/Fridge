<?php

namespace Objects;

use Abstractions\Drink;

class Shelf
{
    //region Variables

    private const LIMIT = 20;

    private int $count = 0;

    /**
     * @var Drink[] $drinks List of drink objects.
     */
    private array $drinks = [self::LIMIT];

    //endregion

    //region Main Methods

    public function put(Drink $drink): bool
    {
        if ($this->isFull()) {
            return false;
        }

        $this->drinks[$this->count] = $drink;
        $this->count++;

        return false;
    }

    public function take(): ?Drink
    {
        if ($this->isEmpty()) {
            return null;
        }

        $this->count--;

        return $this->drinks[$this->count];
    }

    //endregion

    //region Getters

    public function isEmpty(): bool
    {
        return $this->count === 0;
    }

    public function isFull(): bool
    {
        return $this->count === self::LIMIT;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    //endregion
}
