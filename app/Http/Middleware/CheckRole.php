<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $level)
    {
        if (!Auth::check()) {
            return redirect('/sign-in');
        }

        if ($request->user()->level != $level) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
