<?php

namespace App\Exceptions;

use App\Modules\Core\Traits\HttpResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use HttpResponseTrait;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {
        if ($e instanceof AuthenticationException) {
            return $this->unauthorizedResponse('Unauthorized');
        }

        if ($e instanceof ModelNotFoundException) {
            return $this->notFoundResponse('The resource could not be found');
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->notFoundResponse('Route not found');
        }

        dd($e);
        return $this->errorResponse('Unexpected error');
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
