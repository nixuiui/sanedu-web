@extends("layouts.auth")
@section("title")
Login
@endsection
@section("style")
<link rel="stylesheet" href="{{ asset("asset-landing/css/login.css")}}">
@endsection
@section("content")
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <h2 class="active"> MASUK SANEDU</h2>

        <!-- Icon -->
        <div class="fadeIn first">
            <a href="index.php">
                <img src="{{ asset('asset-landing/img/main/icon.svg') }}" alt="User Icon" style="height: 130px; width: 130px;" />
            </a>
        </div>

        <!-- Login Form -->
        <form action="{{ route('auth.login.admin.post') }}" method="POST">
            @if(session('success'))
                <div class="alert alert-success" style="width:85%; margin: 0 auto 15px;">
                    {!! session('success') !!}
                </div>
            @elseif(session('danger'))
                <div class="alert alert-danger" style="width:85%; margin: 0 auto 15px;">
                    {!! session('danger') !!}
                </div>
            @endif
            @csrf
            <input type="text" class="fadeIn second" name="username" placeholder="username">
            <input type="password" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Masuk">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            Lupa Password ? <a class="underlineHover" href="{{ route('auth.password.forgot') }}">RESET PASSWORD</a><br>
            Buat akun ? <a class="underlineHover" href="{{ route('auth.register') }}">DAFTAR</a>
        </div>

    </div>
</div>
@endsection
