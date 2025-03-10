@extends('layouts.admin')

@section('title')
Pengaturan Profil
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <form class="panel panel-default" action="{{ route('alladmin.profil.edit.profil') }}" method="post">
            <div class="panel-heading">
                Profil Anda
            </div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Lengkap" name="nama"  value="{{ $user->nama }}" required>
                    @if ($errors->has('nama'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nomor HP</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Lengkap" name="no_hp"  value="{{ $user->no_hp }}" required>
                    @if ($errors->has('no_hp'))
                    <span class="help-block">
                        <strong>{{ $errors->first('no_hp') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Lengkap" name="alamat"  value="{{ $user->alamat }}" required>
                    @if ($errors->has('alamat'))
                    <span class="help-block">
                        <strong>{{ $errors->first('alamat') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Asal Sekolah</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Lengkap" name="asal_sekolah"  value="{{ $user->asal_sekolah }}" required>
                    @if ($errors->has('asal_sekolah'))
                    <span class="help-block">
                        <strong>{{ $errors->first('asal_sekolah') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control input-sm" placeholder="Nama Lengkap" name="tempat_lahir"  value="{{ $user->tempat_lahir }}" required>
                    @if ($errors->has('tempat_lahir'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tempat_lahir') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan Perubahan</button>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <form class="panel panel-default" action="{{ route('alladmin.profil.edit.email') }}" method="post">
            <div class="panel-heading"><i class="mdi mdi-email"></i> Email</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Gunakan email yang aktif</label>
                    <input type="email" class="form-control input-sm" placeholder="email" name="email"  value="{{ $user->email }}">
                    @if($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan Perubahan</button>
            </div>
        </form>
        <form class="panel panel-default" action="{{ route('alladmin.profil.edit.username') }}" method="post">
            <div class="panel-heading">Username</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control input-sm" placeholder="Username" name="username"  value="{{ $user->username }}">
                    @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan Perubahan</button>
            </div>
        </form>
        <form class="panel panel-default" action="{{ route('alladmin.profil.edit.password') }}" method="post">
            <div class="panel-heading">Kata Sandi</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" class="form-control input-sm" placeholder="Password Lama" name="current_password" >
                    @if ($errors->has('current_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('current_password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" class="form-control input-sm" placeholder="Minimal 6 karakter" name="password" >
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Ulangi Password</label>
                    <input type="password" class="form-control input-sm" placeholder="Ulangi Password" name="password_confirmation" >
                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection
