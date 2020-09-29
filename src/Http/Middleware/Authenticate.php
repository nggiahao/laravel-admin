<?php

namespace Tessa\Admin\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{

    private function checkIfUserIsAdmin(Authenticatable $user)
    {
        // return ($user->is_admin == 1);
        return true;
    }
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->guest()) {
            return $this->unauthenticated($request);
        }

        if (! $this->checkIfUserIsAdmin(Auth::guard('admin')->user())) {
            return $this->unauthenticated($request);
        }

        return $next($request);
    }

    protected function unauthenticated(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        } else {
            return redirect(url('/admin/login'));
        }
    }
}
