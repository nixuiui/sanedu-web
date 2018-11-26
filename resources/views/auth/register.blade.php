@extends('layouts.auth')
@section('title')
Daftar
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('asset-landing/css/login.css')}}">
@endsection

@section('content')
<div class='wrapper fadeInDown'>
    <div id='formContent'>
        <!-- Tabs Titles -->
        <h2 class='active'> DAFTAR MEMBER SANEDU</h2>

        <!-- Icon -->
        <div class='fadeIn first'>
            <a href='index.php'>
                <img src="{{ asset('asset-landing/img/main/icon.svg')}}" alt='User Icon' style='height: 130px; width: 130px;' />
            </a>
        </div>

        <!-- Registrasi -->
        @if($step == 1)
        <form action="{{ route('auth.register') }}" method="GET">
            @if(isset($success))
                <div class="alert alert-success" style="width:85%; margin: 0 auto 15px;">
                    {!! $success !!}
                </div>
            @elseif(isset($danger))
                <div class="alert alert-danger" style="width:85%; margin: 0 auto 15px;">
                    {!! $danger !!}
                </div>
            @endif
            <input type="text" class="fadeIn second input-kap" name="kap" value="{{ old('kap') }}" autofocus required>
            <input type="text" class="fadeIn first input-pin" name="pin" placeholder="PIN" value="{{ old('pin') }}"  required>
            <input type="submit" class="fadeIn fourth" value="LANJUTKAN">
        </form>
        @else
        <form action="{{ route('auth.register.post') }}" method="POST">
            @csrf
            <input type="text" class="fadeIn second" value="{{ $_GET['kap'] }}" disabled required>
            <input type="hidden" class="fadeIn second" name="kap" placeholder="KAP" value="{{ $_GET['kap'] }}" required>
            @if($errors->has('kap'))
            <span class="help-block">
                <span>{{ $errors->first('kap') }}</span>
            </span>
            @endif
            <input type="text" class="fadeIn first" value="{{ $_GET['pin'] }}" disabled required>
            <input type="hidden" class="fadeIn first" name="pin" placeholder="PIN" value="{{ $_GET['pin'] }}" required>
            @if($errors->has('pin'))
            <span class="help-block">
                <span>{{ $errors->first('pin') }}</span>
            </span>
            @endif
            <hr>
            <h2 class='active'> INFORMASI ANDA</h2>
            <input type="text" class="fadeIn third" name="nama" placeholder="NAMA ANDA" autofocus value="{{ old('nama') }}" required>
            @if($errors->has('nama'))
            <span class="help-block">
                <span>{{ $errors->first('nama') }}</span>
            </span>
            @endif
            <input type="text" class="fadeIn fourth" name="alamat" placeholder="ALAMAT" value="{{ old('alamat') }}" required>
            @if($errors->has('alamat'))
            <span class="help-block">
                <span>{{ $errors->first('alamat') }}</span>
            </span>
            @endif
            <input type="text" class="fadeIn fifth" name="asal_sekolah" placeholder="ASAL SEKOLAH" value="{{ old('asal_sekolah') }}" required>
            @if($errors->has('asal_sekolah'))
            <span class="help-block">
                <span>{{ $errors->first('asal_sekolah') }}</span>
            </span>
            @endif
            <input type="text" class="fadeIn sixth" name="kota" placeholder="KOTA / KABUPATEN" value="{{ old('kota') }}" required>
            @if($errors->has('kota'))
            <span class="help-block">
                <span>{{ $errors->first('kota') }}</span>
            </span>
            @endif
            <input type="number" class="fadeIn seventh" name="no_hp" placeholder="NO. HANDPHONE" value="{{ old('no_hp') }}" required>
            @if($errors->has('no_hp'))
            <span class="help-block">
                <span>{{ $errors->first('no_hp') }}</span>
            </span>
            @endif
            <input type="text" class="fadeIn seventh" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
            @if($errors->has('tempat_lahir'))
            <span class="help-block">
                <span>{{ $errors->first('tempat_lahir') }}</span>
            </span>
            @endif
            <input type="text" class="fadeIn eight" name="email" placeholder="EMAIL" value="{{ old('email') }}" required>
            @if($errors->has('email'))
            <span class="help-block">
                <span>{{ $errors->first('email') }}</span>
            </span>
            @endif
            <hr>
            <div class="padd">
                Username dan Password digunakan untuk melakukan login ke Sanedu. Silahkan diingat untuk username dan password.
            </div>
            <input type="text" class="fadeIn eight" name="username" placeholder="Username" value="{{ old('username') }}" required>
            <small class="label">Username: Gunakan huruf, angka tanpa spasi</small>
            @if($errors->has('username'))
            <span class="help-block">
                <span>{{ $errors->first('username') }}</span>
            </span>
            @endif
            <input type="password" class="fadeIn nineth" name="password" placeholder="Password" required>
            @if($errors->has('password'))
            <span class="help-block">
                <span>{{ $errors->first('password') }}</span>
            </span>
            @endif
            <input type="submit" class="fadeIn fourth" value="Daftar" required>
        </form>
        @endif

        <!-- Remind Passowrd -->
        <div id="formFooter">
            Sudah punya akun ? <a class="underlineHover" href="{{ route('auth.login') }}">LOGIN</a>
        </div>

    </div>
</div>

<script src="{{ asset('asset-beagle/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('.input-kap').mask('000000-000000', {placeholder: "KAP"});
    $('.input-pin').mask('0000-0000-0000-0000', {placeholder: "PIN"});
</script>
@endsection
