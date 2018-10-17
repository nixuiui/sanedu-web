<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/checkrole';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $input) {
        $userByEmail = User::where('email', $input->username)->whereIn('id_role', [1004, 1005])->first();
        $userByUsername = User::where('username', $input->username)->whereIn('id_role', [1004, 1005])->first();
        if($userByEmail || $userByUsername) {
            if (Auth::attempt(['email' => $input->username, 'password' => $input->password], true) || Auth::attempt(['username' => $input->username, 'password' => $input->password], true)) {
                return redirect()->route('guest.checkrole');
            }
            return redirect()->back()->with('danger', 'Email/Username yang Anda masukkan tidak cocok');
        }
        return redirect()->back()->with('danger', 'Anda tidak diizinkan login');
    }

    public function loginAdminForm() {
        return view('auth.loginadmin');
    }

    public function loginAdmin(Request $input) {
        if (Auth::attempt(['email' => $input->username, 'password' => $input->password], true) || Auth::attempt(['username' => $input->username, 'password' => $input->password], true)) {
            return redirect()->route('guest.checkrole');
        }
        return redirect()->back()->with('danger', 'Email/Username yang Anda masukkan tidak cocok');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
