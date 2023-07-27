<?php

namespace app\admin\middleware;

class Demo
{
    public function handle($request, \Closure $next)
    {
        echo 99999;
        return $next($request);
    }
}