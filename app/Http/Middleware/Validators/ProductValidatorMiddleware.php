<?php

namespace App\Http\Middleware\Validators;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ProductValidatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|min:1|max:255',
            'price'         => 'required|decimal:0,2',
            'image'         => 'string|max:255|url',
            'description'   => 'string|max:65535'
        ]);

        $validator->validate();

        return $next($request);
    }
}
