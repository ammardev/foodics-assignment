<?php

namespace Foodics\Exceptions;

use Exception;

class AmountInStockIsNotEnough extends Exception
{
    public function __construct()
    {
        parent::__construct('Amount in stock is not enough');
    }
}