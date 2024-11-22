<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckType
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->type != 1) {
          return redirect()->back();
    }

        return $next($request);
    }
}
?>
