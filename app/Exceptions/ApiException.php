<?php

namespace App\Exceptions;

use App\Exceptions\CustomException;

class ApiException extends CustomException
{
    public function __construct()
    {
        parent::__construct('Błąd połączenia z API!');
    }
}
