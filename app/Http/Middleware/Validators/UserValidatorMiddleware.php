<?php

namespace App\Http\Middleware\Validators;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class UserValidatorMiddleware
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
            'email'         => 'required|string|max:255|email|unique:users,email',
            'password'      => 'required|string|min:8|max:255',
            'roles'         => 'array|required',
            'roles.*.id'    => 'required|integer|exists:roles,id'
        ]);

        $validator->validate();

        return $next($request);
    }
}
