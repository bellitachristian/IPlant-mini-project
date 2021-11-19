<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 


class AdminCheck
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
        $checkadmin = User::where('email','admin@gmail.com')->count();
    
        if($checkadmin == 0){
            $pass ='adminadmin';

            $admin = new User;
            $admin->name = 'Admin';
            $admin->email = 'admin@gmail.com';
            $admin->password = Hash::make($pass);
            $admin->save();  
        }
        return $next($request);
    }
}
