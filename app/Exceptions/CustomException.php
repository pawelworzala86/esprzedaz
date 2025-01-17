<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public $name;

    public function __construct($messgage='')
    {
        parent::__construct($messgage);
        $this->name = 'CustomException';
    }
    
    public function render() { 
        return response()->view('error', ['error' => ['message' => $this->getMessage()]]); 
    }
}
