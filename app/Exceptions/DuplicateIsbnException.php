<?php

namespace App\Exceptions;

use Exception;

class DuplicateIsbnException extends Exception
{
    protected $message = 'A book with this ISBN already exists.';
}
