<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTypeUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->type != 2) {
          return redirect()->back();
    }

        return $next($request);
    }
}
?>
