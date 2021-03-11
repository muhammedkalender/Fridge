<?php

namespace Objects;

use Abstractions\Drink;
use Enums\FridgeCapacityStatus;
use Helpers\Logger;

class Fridge
{
    //region Variables

    private bool $open = false;

    /**
     * @var FridgeCapacityStatus $status Status of fridge
     */
    private $capacityStatus = FridgeCapacityStatus::EMPTY;

    /**
     * @var Shelf[] $shelves List of Shelf objects.
     */
    private array $shelves = array(3);

    //endregion

    //region Constructor

    public function __construct()
    {
        for ($i = 0; $i < 3; $i++) {
            $this->shelves[$i] = new Shelf();
        }

        Logger::log("Dolap ve Raflar tanımlandı");
    }

    //endregion

    //region Main Methods

    public function put(Drink $drink): bool
    {
        if (!$this->checkFridgeCover()) {
            return false;
        }

        if ($this->isFull()) {
            Logger::log("Dolap tamamen dolu");

            return false;
        }

        foreach ($this->shelves as $shelf) {
            if ($shelf->isFull()) {
                continue;
            } else {
                $shelf->put($drink);

                $this->updateCapacityStatus();

                Logger::log("İçecek dolaba kondu");

                return true;
            }
        }

        return false;
    }

    public function take(): ?Drink
    {
        if (!$this->checkFridgeCover()) {
            return null;
        }

        if ($this->isEmpty()) {
            Logger::log("Dolap tamamen boş");

            return null;
        }

        foreach ($this->shelves as $shelf) {
            if ($shelf->isEmpty()) {
                continue;
            } else {
                Logger::log("Bir kutu içecek dolaptan alındı");

                $drink = $shelf->take();

                $this->updateCapacityStatus();

                return $drink;
            }
        }

        return null;
    }

    //endregion

    //region Getters

    public function getCount(): int
    {
        $sum = 0;

        foreach ($this->shelves as $shelf) {
            $sum += $shelf->getCount();
        }

        return $sum;
    }

    public function isFull(): bool
    {
        foreach ($this->shelves as $shelf) {
            if (!$shelf->isFull()) {
                return false;
            }
        }

        return true;
    }

    public function isEmpty(): bool
    {
        foreach ($this->shelves as $shelf) {
            if (!$shelf->isEmpty()) {
                return false;
            }
        }

        return true;
    }

    public function isOpen(): bool
    {
        return $this->open;
    }

    //endregion

    //region Setters

    private function setStatus(int $capacityStatus)
    {
        $this->capacityStatus = $capacityStatus;
    }

    private function setOpen(bool $status)
    {
        if ($status) {
            Logger::log("Kapak açıldı");
        } else {
            Logger::log("Kapak kapatıldı");
        }

        $this->open = $status;
    }

    //endregion

    //region Secondary Methods

    private function checkFridgeCover(): bool
    {
        if (!$this->isOpen()) {
            Logger::log("Öncelikle dolabın kapağını açmanız gerekir");

            return false;
        }

        return true;
    }

    private function updateCapacityStatus()
    {
        $status = FridgeCapacityStatus::NOT_FULL;

        if ($this->isEmpty()) {
            $status = FridgeCapacityStatus::EMPTY;
        } else if ($this->isFull()) {
            $status = FridgeCapacityStatus::FULL;
        }

        /** @var FridgeCapacityStatus $status */
        $this->setStatus($status);
    }

    //endregion

    //region Cover Methods

    public function open()
    {
        if ($this->isOpen()) {
            Logger::log("Kapak zaten açık");

            return;
        }

        $this->setOpen(true);
    }

    public function close()
    {
        if (!$this->isOpen()) {
            Logger::log("Kapak zaten kapalı");

            return;
        }

        $this->setOpen(false);
    }

    //endregion

    //region Printers

    public function printStatus()
    {
        switch ($this->capacityStatus) {
            case FridgeCapacityStatus::EMPTY:
                Logger::log("Şuan dolap tamamen boş");
                break;
            case FridgeCapacityStatus::FULL:
                Logger::log("Şuan dolap tamamen dolu");
                break;
            default:
                Logger::log("Şuan dolapta yer var");
                break;
        }
    }

    public function printShelfStatus()
    {
        Logger::log("Raf durumunu yazdırılıyor", true);

        foreach ($this->shelves as $index => $shelf) {
            $printIndex = $index + 1;

            if ($shelf->isFull()) {
                Logger::log("{$printIndex}. Raf tamamen dolu");
            } else if ($shelf->isEmpty()) {
                Logger::log("{$printIndex}. Raf tamamen boş");
            } else {
                Logger::log("{$printIndex}. Rafta yer var");
            }
        }
    }

    //endregion
}
