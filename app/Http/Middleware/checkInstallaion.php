<?php

namespace App\Http\Middleware;

use App\Models\Config\Config;
use Closure;
use Illuminate\Http\Request;

class checkInstallaion
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
        $config = Config::first();
        if ($config->installed) {
            return $next($request);
        } else {
            // return view('config.install');
            return redirect()->route('config.install');
        }
    }
}
