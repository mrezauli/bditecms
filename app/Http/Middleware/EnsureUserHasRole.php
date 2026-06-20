<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $requiredRole = RoleEnum::tryFrom($role);

        if ($requiredRole === null || $request->user()?->role !== $requiredRole) {
            abort(403);
        }

        return $next($request);
    }
}
