<?php

namespace App\Exceptions;

use App\Exceptions\CustomException;

class PetNotFindException extends CustomException
{
    public function __construct()
    {
        parent::__construct('Nie odnaleziono zwierzaka w bazie!');
    }
}
