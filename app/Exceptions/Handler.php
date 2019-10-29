<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        /** handler exception when findOrFail, firstOrFail,... */
        if ($exception instanceof ModelNotFoundException) {
            $error = [
                'type' => 'Model Not Found Exception',
            ];
        }

        /** handler exception when saveOrFail, ... */
        if ($exception instanceof QueryException) {
            $error = [
                'type' => 'Query Exception',
            ];
        }

        /** render custom error */
        if (isset($error) && is_array($error)) {

            if (config('app.env') !== 'production') {
                $error['detail'] = $exception->getMessage();
            }

            $data = [
                'success' => false,
                'data' => null,
                'error' => $error,
            ];

            return response()->json($data);
        }

        /** Default, render error template */
        return parent::render($request, $exception);
    }
}
