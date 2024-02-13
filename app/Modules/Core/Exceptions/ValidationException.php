<?php

namespace App\Modules\Core\Exceptions;

class ValidationException extends \Exception
{
    protected string $column;

    public function __construct(string $column = "", string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $this->column = $column;
        parent::__construct($message, $code, $previous);
    }

    public function column()
    {
        return $this->column;
    }
}
