<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/member';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:member', ['except' => [
            'logout',
            'redirectToLogin',
        ]]);
    }

    public function showLoginForm()
    {
        return view('member.auth.login');
    }


    public function redirectToLogin()
    {
        if ($this->guard('member')->user()) {
            return redirect('/member/');
        }

        return redirect('/member/login');
    }

    protected function guard()
    {
        return Auth::guard('member');
    }

    public function logout(Request $request)
    {
        $respJson = new RespJson();
        try {
            $this->guard('member')->logout();
            return response()->json($respJson);
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
    }
}
