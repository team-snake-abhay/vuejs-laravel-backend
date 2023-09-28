<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        if($request->user() === null){
            return redirect()->guest(route('login'));
        }
        // else if(Auth::user()->mobile_varified_at == null){
        //     return redirect()->intended(route('pub.login.signup'));
        // }        

        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;
    
        if($request->user()->hasAnyRole($roles) || !$roles){
            return $next($request);
        }
        else{
            return redirect()->intended(Auth::user()->url);
        }
        //return response('Insufficent permission',401);
        //return response()->view('errors.403');
    }
}