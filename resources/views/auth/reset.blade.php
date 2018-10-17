@extends("layouts.auth")
@section("title")
Lupa Password
@endsection
@section("style")
<link rel="stylesheet" href="{{ asset("asset-landing/css/login.css")}}">
@endsection
@section("content")
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <h2 class="active"> RESET PASSWORD</h2>

        <!-- Icon -->
        <div class="fadeIn first">
            <a href="index.php">
                <img src="{{ asset('asset-landing/img/main/icon.svg') }}" alt="User Icon" style="height: 130px; width: 130px;" />
            </a>
        </div>

        <!-- Login Form -->
        <form action="{{ route('auth.password.reset.save') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="text" class="fadeIn second" name="password" placeholder="Passworb Baru">
            <input type="text" class="fadeIn second" name="password_confirmation" placeholder="Ulangi Password">
            <input type="submit" class="fadeIn fourth" value="Reset Password">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            Sudah punya akun ? <a class="underlineHover" href="{{ route('auth.login') }}">LOGIN</a><br>
            Buat akun ? <a class="underlineHover" href="{{ route('auth.register') }}">DAFTAR</a>
        </div>

    </div>
</div>
@endsection
