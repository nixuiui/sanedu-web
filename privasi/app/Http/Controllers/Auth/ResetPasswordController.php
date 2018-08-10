<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm($token) {
        $passwordReset = PasswordReset::where("token", $token)->first();
        if($passwordReset != null){
            return view('auth.reset')->with([
                'token' => $token
            ]);
        }
        return redirect()->route('login')->with([
            'success' => '<strong>Permintaan tidak ditemukan</strong> Silahkan kirim email Anda lagi. <a href="'.route("password.reset").'">Lupa Password</a>'
        ]);
    }

    public function reset(Request $input) {
        $this->validate($input, [
            'password'          => 'required|string|min:6|confirmed',
        ]);
        $passwordReset = PasswordReset::where("token", $input->token)->first();
        if($passwordReset != null){
            $user = User::where("email", $passwordReset->email)->first();
            $user->password = bcrypt($input->password);
            if($user->save()) {
                PasswordReset::where("email", $user->email)->update(['token' => 0]);
                return redirect()->route('auth.login')->with([
                    'success' => '<strong>Password berhasil diubah!</strong> Silahkan login.'
                ]);
            }
            return redirect()->route('auth.login')->with([
                'danger' => '<strong>Gagal Merubah Password</strong>'
            ]);
        }
        return redirect()->route('auth.login')->with([
            'danger' => '<strong>Permintaan tidak ditemukan</strong> Silahkan kirim email Anda lagi. <a href="'.route("password.reset").'">Lupa Password</a>'
        ]);
    }
}
