@extends('layouts.admin')

@section('title')
Pengaturan Profil
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <form class="panel panel-default" action="{{ route('user.profil.edit.profil') }}" method="post">
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
                    <input type="text" class="form-control input-sm" placeholder="Nomor HP" name="no_hp"  value="{{ $user->no_hp }}" required>
                    @if ($errors->has('no_hp'))
                    <span class="help-block">
                        <strong>{{ $errors->first('no_hp') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nomor HP Orang Tua</label>
                    <input type="text" class="form-control input-sm" placeholder="Nomor HP Orang Tua" name="no_hp_ortu"  value="{{ $user->no_hp_ortu }}" required>
                    @if ($errors->has('no_hp_ortu'))
                    <span class="help-block">
                        <strong>{{ $errors->first('no_hp_ortu') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control input-sm" placeholder="Alamat" name="alamat"  value="{{ $user->alamat }}" required>
                    @if ($errors->has('alamat'))
                    <span class="help-block">
                        <strong>{{ $errors->first('alamat') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Tingkat Sekolah</label>
                    <select class="form-control input-sm" name="id_tingkat_sekolah" required>
                        <option value="">-- Pilih Tingkat Sekolah --</option>
                        <option value="1301" {{ $user->id_tingkat_sekolah == 1301 ? "selected" : "" }}>SD</option>
                        <option value="1302" {{ $user->id_tingkat_sekolah == 1302 ? "selected" : "" }}>SMP</option>
                        <option value="1303" {{ $user->id_tingkat_sekolah == 1303 ? "selected" : "" }}>SMA</option>
                    </select>
                    @if ($errors->has('asal_sekolah'))
                    <span class="help-block">
                        <strong>{{ $errors->first('asal_sekolah') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Asal Sekolah</label>
                    <input type="text" class="form-control input-sm" placeholder="Asal Sekolah" name="asal_sekolah"  value="{{ $user->asal_sekolah }}" required>
                    @if ($errors->has('asal_sekolah'))
                    <span class="help-block">
                        <strong>{{ $errors->first('asal_sekolah') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control input-sm" placeholder="Tempat Lahir" name="tempat_lahir"  value="{{ $user->tempat_lahir }}" required>
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
        <form class="panel panel-default" action="{{ route('user.profil.edit.email') }}" method="post">
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
        <form class="panel panel-default" action="{{ route('user.profil.edit.username') }}" method="post">
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
        <form class="panel panel-default" action="{{ route('user.profil.edit.password') }}" method="post">
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
