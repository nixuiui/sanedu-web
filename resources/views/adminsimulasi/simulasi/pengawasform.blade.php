@extends('layouts.admin')

@section('title')
Pengawas Simulasi
@endsection

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left"></i> Kembali</a>
@if(isset($pengawas))
<div class="row">
    <div class="col-md-4">
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.pengawas.post', ['id' => $simulasi->id, 'idPengawas' => $pengawas->id]) }}" method="post">
            <div class="panel-body">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $pengawas->profil->nama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $pengawas->profil->email }}</td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td>{{ $pengawas->profil->no_hp }}</td>
                    </tr>
                </table>
                <div class="form-group">
                    <label class="control-label">Ruang Simulasi</label>
                        <select class="form-control input-sm" name="ruang">
                            @foreach($ruang as $r)
                            <option value="{{ $r->id }}" {{ $pengawas->id_ruang == $r->id ? "selected" : ""}}>{{ $r->nama }} {{ $r->pengawas->count() > 0 ? "- " . $r->pengawas->count() . " Pengawas" : "" }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('nama'))
                        <span class="help-block">
                            {{ $errors->first('nama') }}
                        </span>
                        @endif
                </div>
                <div class="xs-mt-10">
                        <button type="submit"  class="btn btn-primary btn-fill btn-md btn-hspace" name="simpan" value="simpan">{{ isset($pengawas) ? "Simpan Perubahan" : "Simpan" }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@else
<button class="btn btn-md btn-primary btn-space" @click="toggleAddMode" v-if="!isAddByEmail">Tambahkan Dengan Akun Yang Sudah Ada</button>
<button class="btn btn-md btn-primary btn-space" @click="toggleAddMode" v-if="isAddByEmail">Buat Akun Baru</button>
<div class="row">
    <div class="col-md-4" v-if="isAddByEmail">
        <form class="panel panel-default form-horizontal" action="{{ route('adminsimulasi.simulasi.kelola.pengawas.post.account', $simulasi->id) }}" method="post">
            <div class="panel-heading">
                Tambahkan akun yang sudah ada
            </div>
            <div class="panel-body">
                @csrf
                <div class="form-group">
                    <label class="control-label col-sm-3">Ruang Simulasi</label>
                    <div class="col-sm-9">
                        <select class="form-control input-sm" name="ruang">
                            @foreach($ruang as $r)
                            <option value="{{ $r->id }}">{{ $r->nama }} {{ $r->pengawas->count() > 0 ? "- Pengawas" . $r->pengawas->count() : "" }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('nama'))
                        <span class="help-block">
                            {{ $errors->first('nama') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Email/Username</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control input-sm" value="{{ isset($pengawas) ? $pengawas->email : old('email') }}" placeholder="Email yang valid" required>
                        @if($errors->has('email'))
                        <span class="help-block">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="row xs-mt-10">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit"  class="btn btn-primary btn-fill btn-md btn-hspace" name="simpan" value="simpan">{{ isset($pengawas) ? "Simpan Perubahan" : "Simpan" }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4" v-if="!isAddByEmail">
        <form class="panel panel-default form-horizontal" action="{{ route('adminsimulasi.simulasi.kelola.pengawas.post', $simulasi->id) }}" method="post">
            <div class="panel-heading">
                Akun Pengawas Ruangan
            </div>
            <div class="panel-body">
                @csrf
                <div class="form-group">
                    <label class="control-label col-sm-3">Ruang Simulasi</label>
                    <div class="col-sm-9">
                        <select class="form-control input-sm" name="">
                            @foreach($ruang as $r)
                            <option value="{{ $r->id }}">{{ $r->nama }} {{ $r->pengawas->count() > 0 ? "- Pengawas" . $r->pengawas->count() : "" }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('nama'))
                        <span class="help-block">
                            {{ $errors->first('nama') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control input-sm" value="{{ isset($pengawas) ? $pengawas->nama : old('nama') }}" placeholder="Nama Lengkap" required>
                        @if($errors->has('nama'))
                        <span class="help-block">
                            {{ $errors->first('nama') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control input-sm" value="{{ isset($pengawas) ? $pengawas->email : old('email') }}" placeholder="Email yang valid" required>
                        @if($errors->has('email'))
                        <span class="help-block">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Username</label>
                    <div class="col-sm-9">
                        <input type="text" name="username" class="form-control input-sm" value="{{ isset($pengawas) ? $pengawas->username : old('username') }}" placeholder="Username" required>
                        @if($errors->has('username'))
                        <span class="help-block">
                            {{ $errors->first('username') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Password</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control input-sm" value="{{ isset($pengawas) ? $pengawas->password : old('password') }}" placeholder="Nama Tempat" required>
                        @if($errors->has('password'))
                        <span class="help-block">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="row xs-mt-10">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit"  class="btn btn-primary btn-fill btn-md btn-hspace" name="simpan" value="simpan">{{ isset($pengawas) ? "Simpan Perubahan" : "Simpan" }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endif
@endsection

@section('script')
<script type="text/javascript">
var app = new Vue({
    el: "#app",
    data: {
        isAddByEmail: false,
    },
    methods: {
        toggleAddMode: function() {
            this.isAddByEmail = !this.isAddByEmail;
        }
    }
});
</script>
@endsection
