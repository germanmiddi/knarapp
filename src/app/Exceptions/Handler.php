<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // Detecta si la solicitud es por API
        if ($request->expectsJson()) {
            return response()->json(['message' => 'No autenticado.'], Response::HTTP_UNAUTHORIZED);
        }
    
        // Manejo para solicitudes web
        return redirect()->guest(route('login'));
    }    


}
