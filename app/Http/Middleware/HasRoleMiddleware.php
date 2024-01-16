<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;
use App\Exceptions\InsufficientPrivilegesException;

class HasRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $role = Role::where('name', $role)->first();

        if (is_null($role))
            throw new InsufficientPrivilegesException();

        if  (!$request->user()->roles()->where('role_id', $role->id)->count())
            throw new InsufficientPrivilegesException();

        return $next($request);
    }
}
