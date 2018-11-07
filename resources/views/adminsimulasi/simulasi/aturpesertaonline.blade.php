@extends('layouts.admin')

@section('title')
Jadwal Online
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-md-4">
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.peserta.online.post', $simulasi->id) }}" method="post">
            <div class="panel-heading">
                Form Penempatan Peserta Online
            </div>
            <div class="panel-body">
                @csrf
                <div class="form-group">
                    <label><strong>Tanggal</strong></label>
                    <select class="form-control input-sm" name="id_jadwal_online" required>
                        <option value="">-- Pilih Jadwal Online --</option>
                        @foreach($jadwal as $data)
                        <option value="{{ $data->id }}">{{ hariTanggal($data->tanggal) }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('id_jadwal_online'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_jadwal_online') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>Username Peserta</strong></label>
                    <input type="text" name="username" class="form-control input-sm" placeholder="username" required>
                    @if($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-default btn-fill btn-md btn-space" name="simpan" value="simpan">Simpan</button>
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-space" name="simpan" value="simpanandnext">Simpan dan Masukan Lagi</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
