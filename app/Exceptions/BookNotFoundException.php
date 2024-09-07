<?php

namespace App\Exceptions;

use Exception;

class BookNotFoundException extends Exception
{
    protected $message = 'The requested book was not found.';
}

