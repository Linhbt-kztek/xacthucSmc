<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    { 
        if($this->isHttpException($exception)) { 
            if(substr($request->path(), 0, 3) == "api") {
                $response = [];
                if($exception->getStatusCode() == 404) {
                    $response["status"] = 404;
                    $response["message"] = "Error 404 Not Found";
                    $response["data"] = [];
                } elseif($exception->getStatusCode() == 500) {
                    $response["status"] = 500;
                    $response["message"] = "500 Internal Server Error";
                    $response["data"] = [];
                } else {
                    $response["status"] = 400;
                    $response["message"] = "400 Bad Request";
                    $response["data"] = [];
                }
                return response()->json($response);
            } else {
                switch ($exception->getStatusCode()) {
                    // not found
                    case 404:
                        return redirect()->route('frontend.site.error');
                        break;

                    // internal error
                    case '500':
                        return redirect()->route('frontend.site.error');
                        break;

                    default:
                        return $this->renderHttpException($exception);
                        break;
                }
            }
        } else {
            return parent::render($request, $exception);
        }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
