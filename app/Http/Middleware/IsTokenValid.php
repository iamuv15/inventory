<?php

namespace App\Http\Middleware;

use Closure;

class IsTokenValid
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
        // $check = DB::table('kerberos_auth')->where('')

        return Auth::user()->id;
    }
}
