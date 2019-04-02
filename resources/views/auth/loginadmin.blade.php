@extends("layouts.auth")

@section("title")
Login
@endsection

@section("desc")
Kita mulai belajar dengan cara yang menyenangkan...
@endsection

@section("content")
<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Masuk ke Akun Sanedu.</h3>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show with-icon" role="alert">
                    {!! session('success') !!}
                </div>
            @elseif(session('danger'))
                <div class="alert alert-danger alert-dismissible fade show with-icon" role="alert">
                    {!! session('danger') !!}
                </div>
            @endif
            <form action="{{ route('auth.login.admin.post') }}" method="POST">
                @csrf
                <input class="form-control" type="text" name="username" placeholder="Email/Username" required>
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                <div class="form-button">
                    <button id="submit" type="submit" class="ibtn">Masuk</button> <a href="{{ route('auth.password.forgot') }}">Lupa password?</a>
                </div>
            </form>
            <div class="other-links">
                <span>Belum punya akun?</span><a href="{{ route('auth.register') }}">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection