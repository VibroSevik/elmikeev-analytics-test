<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (SymfonyResponse) $next
     * @return SymfonyResponse
     * @throws HttpResponseException
     */
    public function handle(Request $request, Closure $next): SymfonyResponse
    {
        if ($request->input('key') != env('APP_KEY')) {
            throw new HttpResponseException(
                new Response(
                    ['error' => 'Token invalid or empty'],
                    Response::HTTP_UNAUTHORIZED,
                    ['Content-Type' => 'applications/json']
                )
            );
        }

        return $next($request);
    }
}
