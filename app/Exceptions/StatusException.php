<?php

namespace App\Exceptions;

use App\Exceptions\CustomException;

class StatusException extends CustomException
{
    public function __construct()
    {
        parent::__construct('Nieznany status pozycji w sklepie!');
    }
}
