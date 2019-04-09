<?php

namespace App\Exceptions;

use Exception;
use App\Http\Responses\HttpResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Core\Users\Exceptions\UserInvalidArgumentException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        $data = [
            'request_uri' => $request->getUri(),
            'parameters' => $request->all()
        ];

        if ($exception instanceof UserInvalidArgumentException) {
            throw HttpResponse::fail(40001, $data,$exception->getMessage());
        }

        if($exception instanceof ValidationException){
            throw HttpResponse::fail(40002, json_decode($exception->getResponse(),true),$exception->getMessage());
        }

        if($exception instanceof NotFoundHttpException){
            throw HttpResponse::fail(40401,$data,$exception->getMessage());
        }

        if ($exception instanceof HttpResponseException) {
            return $exception->getResponse();
        }

        if($exception){
            $data = [
                'message' => $exception->getMessage(),
                'exception class' => get_class($exception),
                'exception code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ];
            throw HttpResponse::fail(50000,$data);
        }
        return parent::render($request, $exception);
    }
}
