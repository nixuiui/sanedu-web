<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\User;
use App\Models\Tiket;
use App\Models\Provinsi;
use Uuid;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function registerForm(Request $input) {
        $kap = str_replace("-", "", $input->kap);
        $pin = str_replace("-", "", $input->pin);
        if(!isset($_GET['email'])) {
            if($pin == null || $kap == null)
                return view('auth.register')->with('step', 1);
            $tiket = Tiket::where('pin', $pin)->where('kap', $kap);
            if($tiket->first() == null)
                return view('auth.register')->with(['step' => 1, 'danger' => 'Nomor PIN dan KAP tidak tersedia']);
            $tiket = $tiket->where('id_user', null);
            if($tiket->first() == null)
                return view('auth.register')->with(['step' => 1, 'danger' => 'Anda sudah melakukan pendaftaran, untuk Login silahkan klik link <a href="' . route('auth.login') . '">Login</a> di bawah dengan menggunakan Username dan Password yang telah Anda isi pada kolom pendaftaran']);
            return view('auth.register')->with('step', 2);
        }
        else {
            $user = User::where("email", $input->email)->first();
            $provinsi = Provinsi::all();
            if($user != null) {
                return view('auth.register')->with(["step" => 2, "danger" => "Maaf email yang Anda gunakan sudah terdaftar. Silahkan coba email lain!"]);
            }
            else {
                return view('auth.register')->with('step', 3)->with([
                    'provinsi' => $provinsi
                ]);
            }
        }
    }

    public function register(Request $input) {
        $this->validate($input, [
            'nama'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:tbl_users,email',
            'username'          => 'required|alpha_dash|unique:tbl_users,username|min:6|max:255',
            'password'          => 'required|string|min:6',
            'tanggal_lahir'     => 'required|date',
            'id_sekolah'        => 'required|exists:tbl_sekolah,id',
        ]);
        $kap = str_replace("-", "", $input->kap);
        $pin = str_replace("-", "", $input->pin);
        $tiket = Tiket::where('pin', $pin)->where('kap', $kap);
        if($tiket->first() == null)
            return redirect()->back()->with('danger', 'Nomor PIN dan KAP tidak tersedia');
        $tiket = $tiket->where('id_user', null);
        if($tiket->first() == null)
            return redirect()->back()->with('danger', 'Anda sudah melakukan pendaftaran, untuk Login silahkan klik link <a href="' . route('auth.login') . '">Login</a> di bawah dengan menggunakan Username dan Password yang telah Anda isi pada kolom pendaftaran');
        $tiket = $tiket->first();
        $id_role = $tiket->id_kategori_tiket == 1102 ? 1005 : 1004;
        $user = new User;
        $user->id = Uuid::generate();
        $user->id_role = $id_role;
        $user->nama = $input->nama;
        $user->email = $input->email;
        $user->username = $input->username;
        $user->password = bcrypt($input->password);
        $user->no_hp = $input->no_hp;
        $user->no_hp_ortu = $input->no_hp_ortu;
        $user->alamat = $input->alamat;
        $user->tempat_lahir = $input->tempat_lahir;
        $user->tanggal_lahir = $input->tanggal_lahir;
        $user->id_sekolah = $input->id_sekolah;
        $user->email_verification_code = bcrypt($user->username . rand(1000,5000));
        if($user->save()){
            $tiket = Tiket::where("kap", $kap)->where("pin", $pin)->first();
            $tiket->id_user = $user->id;
            if($tiket->save()) {
                $dataEmail = [
                    'nama'      => $user->nama,
                    'username'  => $user->username,
                    'code'      => $user->email_verification_code
                ];
                Mail::send('email.registration', $dataEmail, function ($mail) use ($user)  {
                    $mail->to($user->email, $user->name);
                    $mail->subject('Sanedu.id - Konfirmasi Email Anda');
                });
                return redirect()->route('auth.login')->with([
                    'success' => '<strong>Berhasil Daftar!</strong> Silahkan cek email Anda dan lakukan konfirmasi email.
                                    Belum dapat email? <a href="'.route("email.verification.resend", ["username" => $user->username]).'">Kirim Ulang.</a>'
                ]);
            }
            $user->delete();
            return redirect()->back()->with('danger', 'Maaf terjadi kesalahan saat mendaftar, silahkan ulang kembali.');
        }
        return redirect()->back()->with('danger', 'Maaf pendaftaran Anda gagal, silahkan ulang kembali.');

    }
}
