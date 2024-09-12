<?php

namespace App\Exceptions;

use Exception;

class DuplicateEntryException extends Exception
{
    protected $message = 'A record with this entry already exists.';
}
