<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Mail;
use Auth;

class MailController extends Controller
{
    public function test() {
        Mail::send('email.example', ["data" => "Data"], function ($mail)  {
            $mail->to("nikirahmadiwiharto@gmail.com", "nikirahmadiwiharto");
            $mail->subject('Password Anda Telah Diubah');
        });
        return 0;
    }

    public function verifyRegistration(Request $input){
        $user = User::where('username', $input->username)
        ->where('email_verification_code', $input->code)
        ->first();
        if($user != null){
            $user->email_is_verified = 1;
            $user->email_verification_code = null;
            if($user->save())
            return redirect()->route('auth.login')->with('success', 'Email Anda Sudah Terverifikasi. Silahkan Login');
        }
        return redirect()->route('auth.login');
    }



    public function resendVerification($username){
        $user = User::where('username', $username)->first();
        if($user != null){
            //Code for verification
            $user->email_verification_code    = bcrypt($username . rand(1000,5000));
            if($user->save()){
                $data = [
                    'nama'      => $user->nama,
                    'username'  => $user->username,
                    'code'      => $user->email_verification_code
                ];
                Mail::send('email.registration', $data, function ($mail) use ($user)  {
                    $mail->to($user->email, $user->name);
                    $mail->subject('Sanedu.id - Konfirmasi Email Anda');
                });
                if(Auth::check()) {
                    return view('email.verificationview')->with([
                        'success' => '<strong>Berhasil dikirim!</strong> Silahkan cek email Anda dan lakukan konfirmasi email.
                        Belum dapat email? <a href="'.route("email.verification.resend", ["username" => $user->username]).'">Kirim Ulang.</a>'
                    ]);
                }
                return redirect()->route('auth.login')->with([
                    'success' => '<strong>Berhasil dikirim!</strong> Silahkan cek email Anda dan lakukan konfirmasi email.
                    Belum dapat email? <a href="'.route("email.verification.resend", ["username" => $user->username]).'">Kirim Ulang.</a>'
                ]);
            }
        }
        return redirect()->route('auth.login')->with('error', 'Akun belum terdaftar.');
    }
}
