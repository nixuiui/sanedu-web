@extends("layouts.auth")

@section("title")
Login
@endsection

@section("desc")
Kami disini akan membantu menganalisis nilai UTBK Anda...
@endsection

@section("content")
<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Analisis UTBK</h3>
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
                <input class="form-control" type="text" name="no_utbk" placeholder="No. UTBK" required>
                <div class="form-button full-width">
                    <button id="submit" type="submit" class="ibtn mb-2">Masuk</button> 
                </div>
            </form>
            <div class="other-links text-center">
                <span>Belum input Nilai UTBK? <a href="{{ route('guest.utbk.input') }}">Yuk input sekarang</a></span>
            </div>
        </div>
    </div>
</div>
@endsection