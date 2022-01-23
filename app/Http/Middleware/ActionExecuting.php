<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActionExecuting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // トランザクション開始処理
        return $next($request);
    }
}
