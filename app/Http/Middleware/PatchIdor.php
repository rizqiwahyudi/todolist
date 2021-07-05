<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todolist;

class PatchIdor
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
        $id = Todolist::select('id')->where('user_id', Auth::user()->id);

        if ($request->route()->id != $id) {
            return redirect('/dashboard')->with(['error' => 'Access Denied !']);
        }
        
        return $next($request);
    }
}
