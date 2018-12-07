<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Board;
class OwnerMiddleware
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

        $user = Auth::user();
        $id = $request->route('board');
        $b = Board::find($id);
        if(!$b || $user->id != $b->user_id){
            flash('해당 권한이 존재하지 않습니다.')->error();
            return back();
        }
        return $next($request);
    }
}
