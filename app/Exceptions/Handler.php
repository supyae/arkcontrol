<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;
use Symfony\Component\HttpKernel\Exception\PreconditionRequiredHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class Handler extends ExceptionHandler
{
    protected $statusCode = 500;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //Custom Api Error Handling
        if (
            $exception instanceof UnauthorizedHttpException
            || $exception instanceof TokenBlacklistedException
            || $exception instanceof TokenMismatchException
            || $exception instanceof NotFoundHttpException
            || $exception instanceof AccessDeniedHttpException
            || $exception instanceof BadRequestHttpException
            || $exception instanceof ConflictHttpException
            || $exception instanceof MethodNotAllowedHttpException
            || $exception instanceof MethodNotAllowedException
            || $exception instanceof PreconditionFailedHttpException
            || $exception instanceof PreconditionRequiredHttpException
            || $exception instanceof ServiceUnavailableHttpException
            || $exception instanceof TooManyRequestsHttpException
            || $exception instanceof UnauthorizedHttpException
            || $exception instanceof UnprocessableEntityHttpException
            || $exception instanceof UnsupportedMediaTypeHttpException
            || $exception instanceof \ErrorException
        ) {
            return $this->setStatusCode($exception->getStatusCode())
                ->respondWithError($exception->getMessage());
        }


        return parent::render($request, $exception);
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function respondWithError($message, $data = [])
    {
        if (is_array($message)) {
            $message = implode(',', $message);
        }

        $respond = [
            "meta" => [
                'success'    => false,
                'messages'   => $message,
                'statusCode' => $this->getStatusCode()
            ]
        ];

        return Response::json($respond, $this->getStatusCode());
    }
}
