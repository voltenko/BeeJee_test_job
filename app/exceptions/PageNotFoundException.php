<?php
namespace app\exceptions;


class PageNotFoundException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        header("HTTP/1.0 404 Not Found");
    }
}