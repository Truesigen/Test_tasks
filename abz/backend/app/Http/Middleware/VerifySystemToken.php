<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifySystemToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $systemToken = $request->header('Authorization');

        $token = app(\App\Models\SystemToken::class)->where('name', $systemToken)->first();

        if (!$request->header('Authorization') || ! $token) {
            return response()->json(['success' => false, 'Unauthorized'], 401);
        }

        if (strtotime($token->expires_at) < strtotime(now())) {
            return response()->json(['success' => false, 'message' => 'The token expired.'], 401);
        }

        return $next($request);
    }
}
