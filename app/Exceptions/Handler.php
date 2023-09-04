<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use App\Http\Controllers\BaseAPIController;

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
        $this->reportable(function (Throwable $e) {
            
            //
        });

        $this->renderable(function (Throwable $e) {
          
            if (request()->expectsJson()) {
                if ($e instanceof MethodNotAllowedHttpException) {
                    return BaseAPIController::error(
                        [],
                        config('app.debug') ? $e->getMessage() : 'Invalid request method. Please contact administrator.',
                        $e->getStatusCode()
                    );
                }

                if ($e instanceof ValidationException) {
                    $errors = array_map(fn($error) => $error[0], $e->errors());
                    return BaseAPIController::error($errors, 'Validation error', Response::HTTP_UNPROCESSABLE_ENTITY);
                }

                if ($e instanceof AccessDeniedHttpException) {
                    return BaseAPIController::error(
                        [],
                        ($e->getMessage() != 'This action is unauthorized.') ? $e->getMessage() : 'You don\'t have sufficient permission',
                        $e->getStatusCode()
                    );
                }

                if ($e instanceof NotFoundHttpException) {

                    if ($e->getPrevious() instanceof ModelNotFoundException) {
                        return BaseAPIController::error([], $e->getMessage(), Response::HTTP_NOT_FOUND);
                    }
        
                    return BaseAPIController::error([], 'Route not found', Response::HTTP_NOT_FOUND);
                }


                if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
                    return BaseAPIController::error([], $e->getMessage(), Response::HTTP_UNAUTHORIZED);
                }

                if ($e instanceof AuthenticationException) {
                    return BaseAPIController::error([], $e->getMessage(), Response::HTTP_UNAUTHORIZED);
                }

                if (app()->isLocal()) {
                    return BaseAPIController::error($e, $e->getMessage(), (method_exists($e, 'getStatusCode')) ? $e : Response::HTTP_INTERNAL_SERVER_ERROR); // $e->getStatusCode()
                } else {
                    return BaseAPIController::error([], $e->getMessage(), (method_exists($e, 'getStatusCode')) ? $e : Response::HTTP_INTERNAL_SERVER_ERROR); // $e->getStatusCode()
                }

            }

            if ($e instanceof HttpException) {
                if ($e->getStatusCode() == 419) {
                    return BaseAPIController::error([], 'Sorry your session has expired. Please refresh and try again', Response::HTTP_UNAUTHORIZED);
                  
                }
            }


        });

                
    }
}
