<?php

namespace App\Exceptions;

use Exception;

class MonthlyfeeExecption extends Exception
{
    public function __construct()
    {
        parent::__construct(message: 'Monthlyfee does not belongs to student', code: 001);
    }
}
