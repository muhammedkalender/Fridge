<?php

namespace Objects;

use Abstractions\Drink;

class Coke extends Drink
{
    //region Variables

    private int $acidRatio = 15;

    //endregion

    //region Constructor

    public function __construct()
    {
        parent::__construct("Kola");
    }

    //endregion

    //region Main Methods

    public function getInfo() : string
    {
        return "İçecek Adı : {$this->getName()}, Asitlik Oranı : {$this->acidRatio}%";
    }

    //endregion
}
