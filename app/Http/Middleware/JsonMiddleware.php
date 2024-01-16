<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\InvalidRequestException;

class JsonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->expectsJson())
            throw new InvalidRequestException();

        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            $json = json_decode($request->getContent());

            if (is_null($json) || (!is_object($json)))
                throw new InvalidRequestException("Http request body is not a json object");
        }

        return $next($request);
    }
}
