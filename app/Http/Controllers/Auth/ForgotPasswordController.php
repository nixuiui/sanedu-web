<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\User;
use App\Models\PasswordReset;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm() {
        return view('auth.forgot');
    }

    public function sendResetLinkEmail(Request $input){
        $email = $input->email;
        $user = User::where('email', $email)->first();
        if($user != null) {
            $token = date("Y").date("m").date("d").date("H").date("i").date("s").str_random(64);
            $data = [
                'nama'      => $user->nama,
                'email'     => $user->email,
                'token'     => $token
            ];
            PasswordReset::where("email", $user->email)->update(['token' => 0]);
            $passwordReset = new PasswordReset;
            $passwordReset->email = $user->email;
            $passwordReset->token = $token;
            if($passwordReset->save()) {
                // Mail::send('email.passwordreset', $data, function ($mail) use ($user) {
                //     $mail->to($user->email, $user->nama);
                //     $mail->subject('Sanedu.id - Reset Password');
                // });
                return redirect()->route('auth.login')->with([
                    'success' => '<strong>Permintaan Terkirim!</strong> Silahkan cek email Anda untuk mendapatkan link reset password.'
                ]);
            }
            return back()->with('danger', 'Gagal menyimpan token');
        }
        return back()->with('danger', 'Email belum terdaftar');
    }
}
