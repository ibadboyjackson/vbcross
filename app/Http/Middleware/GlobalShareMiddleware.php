<?php

namespace App\Http\Middleware;

use Closure;

class GlobalShareMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \View::share('unreadMessagesCount', \App\Chat::where('receiver_id' , \auth()->id())->whereNull('read_at')->get()->count());
        return $next($request);
    }
}
