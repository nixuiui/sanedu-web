<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Google_Client;

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
            return redirect()->back()->with('danger', 'Maaf, Password yang Anda masukkan salah.');
        }
        return redirect()->back()->with('danger', 'Maaf, email/username yang Anda masukkan belum terdaftar');
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

    public function loginWithGoogle(Request $input) {
        $CLIENT_ID = "799758054471-0ni1243o0qtq17t9b5fu5l4s4c7q9cgh.apps.googleusercontent.com";
        $client = new Google_Client(['client_id' => $CLIENT_ID]);
        $payload = $client->verifyIdToken($input->id_token);
        if ($payload) {
            $email = $payload['email'];
            $user = User::where('email', $email)->first();
            if ($user && Auth::loginUsingId($user->id)) {
                return json_encode(['success' => true, 'action' => 'login']);
            }
            else {
                return json_encode(['success' => true, 'action' => 'register']);
            }
        } else {
            return json_encode(['success' => false]);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
