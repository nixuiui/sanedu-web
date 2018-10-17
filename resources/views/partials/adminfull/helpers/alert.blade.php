<div class="row">
    <div class="col-md-12">
        @if(!Auth::user()->email_is_verified)
            {{ htmlAlert('danger', 'Maaf email Anda belum dikonfirmasi. Silahkan cek email Anda untuk konfirmasi email Anda. Apakah Anda tidak mendapat email konfirmasi? <a href="'.route("email.verification.resend", ["username" => Auth::user()->username]).'">Kirim Ulang.</a>') }}
        @endif
        @if(session('success'))
            {{ htmlAlert('success',session('success')) }}
        @elseif(session('danger'))
            {{ htmlAlert('danger',session('danger')) }}
        @endif
    </div>
</div>
