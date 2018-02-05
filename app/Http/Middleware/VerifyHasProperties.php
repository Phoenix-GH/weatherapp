<?php

namespace App\Http\Middleware;

use Closure;

class VerifyHasProperties
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
        if ($request->user()->currentTeam->properties->count() == 0) {
            return redirect('onboard/2/import');
        }
        return $next($request);
    }
}
