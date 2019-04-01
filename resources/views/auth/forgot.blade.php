@extends("layouts.auth")
@section("title")
Login
@endsection

@section("desc")
Untuk Anda yang lupa password, jangan khawatir...
@endsection

@section("content")
<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Lupa Password</h3>
            <p>Tulis email Anda di bawah ini</p>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show with-icon" role="alert">
                    {!! session('success') !!}
                </div>
            @elseif(session('danger'))
                <div class="alert alert-danger alert-dismissible fade show with-icon" role="alert">
                    {!! session('danger') !!}
                </div>
            @endif
            <form action="{{ route('auth.password.email') }}" method="POST">
                @csrf
                <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                <div class="form-button full-width">
                    <button type="submit" class="ibtn">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection