<?php

namespace App\Http\Middleware;

use Closure;

class CheckExpiry
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
        $parameters = ['state' => "Your Session Has Logged out,   Please Login Again"];
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            if(!isset($_SESSION['EX_TIME']))
            {
                $parameters = ['state' => "Please Login to Use the site"];
            }
        }
        if(isset($_SESSION['EX_TIME']) && ($_SESSION['EX_TIME']-time()>0))
        {
            return $next($request);
        }
        else
        {
            session_unset();
            session_destroy();

            return redirect('/login')->with($parameters);
            //return redirect('oauth');
        }
    }

}
