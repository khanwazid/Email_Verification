<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (MethodNotAllowedHttpException $e) {
            return redirect()->route('login');
        });
        $this->reportable(function (Throwable $e) {
            //
        });
       


        $this->renderable(function (ThrottleRequestsException $e, $request) {
            $headers = $e->getHeaders();
            
            return response()->json([
                'status' => false,
                'message' => 'Rate limit exceeded',
                'details' => [
                    'error' => 'Too many requests',
                    'retry_after_seconds' => $headers['Retry-After'] ?? 60,
                    'retry_after_time' => now()->addSeconds($headers['Retry-After'] ?? 60)->format('Y-m-d H:i:s'),
                    'limit' => $headers['X-RateLimit-Limit'] ?? 60,
                    'remaining_attempts' => $headers['X-RateLimit-Remaining'] ?? 0
                ]
            ], 429, $headers);
        });
    }
}
