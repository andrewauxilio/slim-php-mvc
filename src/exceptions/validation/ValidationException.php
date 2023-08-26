<?php

namespace app\exceptions\validation;

use Exception;

class ValidationException extends Exception
{
    public function __construct(array $errors)
    {
        parent::__construct(json_encode($errors), 422);
    }
}