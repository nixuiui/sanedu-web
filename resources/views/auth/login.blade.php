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
            <form action="{{ route('auth.login.post') }}" method="POST">
                @csrf
                <input class="form-control" type="text" name="username" placeholder="Email/Username" required>
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                <div class="form-button full-width">
                    <button id="submit" type="submit" class="ibtn mb-2">Masuk</button> 
                    {{-- <div id="customBtn" class="customGPlusSignIn ibtn mb-3">
                        <img src="{{ asset('asset-sanone/images/g-normal.png') }}" alt="">
                        <span class="buttonText">Google</span>
                    </div> --}}
                    <div class="text-center">
                        <a href="{{ route('auth.password.forgot') }}">Lupa password?</a>
                    </div>
                </div>
                <script>startApp();</script>
            </form>
            <div class="other-links text-center">
                <span>Belum punya akun? <a href="{{ route('auth.register') }}">Daftar Sekarang</a></span>
            </div>
        </div>
    </div>
</div>
@endsection