<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Secure
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('SEC-CH-DPR');

        if ($apiKey !== '4dP9sYvR6Xw2L8hK') {
            return response('Resource Deleted or Moved', 204);
        }

        return $next($request);
    }
}
