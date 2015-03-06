<?php namespace Survey\Http\Middleware;

use Closure;

class SurveyPermissions {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $user = \Auth::user();
        if($user->role["admin"])
            return $next($request);
        switch($request->method()){
            case 'POST':
                if(!$user->role['survey.create'])
                    return redirect()->back()->withErrors(['page'=>'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
                break;
            case 'PATCH':
                if(!$user->role['survey.edit'])
                    return redirect()->back()->withErrors(['page'=>'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
                break;
            case 'DELETE':
                if(!$user->role['survey.delete'])
                    return redirect()->back()->withErrors(['page'=>'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
                break;
            default:
                if(!$user->role['survey.view'])
                    return redirect()->back()->withErrors(['page'=>'Es ist ihnen nicht gestattet diese Aktion auszuführen.']);
                break;
        }
        return $next($request);
	}

}
