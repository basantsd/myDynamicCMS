<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = User::find(session('user_id'));

        if (!$user || (!$user->isAdmin() && !$user->hasPermission($permission))) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
