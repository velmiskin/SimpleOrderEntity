<?php


namespace App\Exceptions;


final class InvalidOrderException extends \Exception
{

    /**
     * Exception report
     *
     * @return bool|null
     */
    public function report(): bool
    {
        return false;
    }

}
