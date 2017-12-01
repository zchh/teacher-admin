<?php namespace App\Http\Middleware;

use Closure;

class TLoginTeacherCheck {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(false == empty(session("teacher"))) {
            return $next($request);
        } else {
            return redirect("/t_teacher_login");
        }
    }

}
