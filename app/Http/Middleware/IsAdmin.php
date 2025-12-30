<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // If user is Admin, allow everything
        if ($user->hasRole('Admin') || $user->role === 'Admin') {
            return $next($request);
        }

        // Check if user has ANY permission defined in the system
        // This ensures that anyone who has been granted ANY access in the Roles UI can at least enter the admin area.
        // The specific controller permissions will then restrict them further.
        $hasAnyPermission = $user->permissions->count() > 0 || $user->getPermissionsViaRoles()->count() > 0;

        if (!$hasAnyPermission) {
            abort(403, 'Unauthorized access. Your account does not have any permissions assigned. Please contact the administrator.');
        }

        return $next($request);
    }
}
