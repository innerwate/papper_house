<?php

namespace App\Http\Middleware;
use App\office;
use DB;
use Closure;

class CheckReg
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
        $users = office::all();
        foreach($users as $user){
            if($user->login == $request->login){
                $data['massage'] = 'This login allready exist!';
            }
        }
       
        return $next($request);
    }
}
