<?php
namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

abstract class SystemDefaultExceptions extends Exception
{
    abstract function response(): Response;
}
