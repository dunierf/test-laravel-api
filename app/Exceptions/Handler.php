<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use App\Exceptions\InvalidRequestException;
use App\Exceptions\InsufficientPrivilegesException;

class Handler extends ExceptionHandler
{
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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e) {
            return $this->handle($e);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function handle(Throwable $e)
    {
        $code = Response::HTTP_BAD_REQUEST;
        $errors = NULL;

        if (($e instanceof NotFoundHttpException) || ($e instanceof ModelNotFoundException))
        {
            $code = Response::HTTP_NOT_FOUND;
            $msg = 'Not found';
        }
        elseif ($e instanceof AuthenticationException)
        {
            $code = Response::HTTP_UNAUTHORIZED;
            $msg = 'Authentication required';
        }
        elseif ($e instanceof ValidationException)
        {
            $msg = 'Validation failed';
            $errors = $e->errors();
        }
        else
        {
            if (($e instanceof InvalidRequestException) || ($e instanceof MethodNotAllowedHttpException))
                $code = Response::HTTP_NOT_ACCEPTABLE;
            elseif ($e instanceof InsufficientPrivilegesException)
                $code = Response::HTTP_FORBIDDEN;
            elseif ($e instanceof InactiveUserException)
                $code = Response::HTTP_UNAUTHORIZED;

            $msg = $e->getMessage();
        }

        $response = $errors ? [
            'msg'       => $msg,
            'errors'   => $errors
        ] : [
            'msg'       => $msg
        ];

        return response()->json($response, $code);
    }
}
