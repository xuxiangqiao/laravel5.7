<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
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
        //判断请求
        if($request->input('_token')!='1811class'){
            return redirect()->to('http://www.baidu.com');
        }
        
        return $next($request);
    }
}
