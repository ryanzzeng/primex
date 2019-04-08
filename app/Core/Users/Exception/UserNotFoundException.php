<?php

namespace App\Core\Users\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('User is not existed.');
    }
}
