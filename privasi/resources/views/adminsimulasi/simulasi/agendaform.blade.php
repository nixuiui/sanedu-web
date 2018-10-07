@extends('layouts.admin')

@section('title')
Soal Ujian
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-md-6">
        @if(isset($agenda))
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.agenda.post', ['id' => $simulasi->id, 'idAgenda' => $agenda->id]) }}" method="post">
        @else
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.agenda.post', $simulasi->id) }}" method="post">
        @endif
            <div class="panel-heading">
                Form Kegiatan Simulasi
            </div>
            <div class="panel-body">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Waktu Mulai</strong></label>
                            <input type="time" name="waktu_mulai" class="form-control input-sm" value="{{ isset($agenda) ? date('H:i', strtotime($agenda->waktu_mulai)) : old('waktu_mulai') }}" required>
                            @if($errors->has('waktu_mulai'))
                            <span class="help-block">
                                <strong>{{ $errors->first('waktu_mulai') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Waktu Selesai</strong></label>
                            <input type="time" name="waktu_selesai" class="form-control input-sm" value="{{ isset($agenda) ? date('H:i', strtotime($agenda->waktu_selesai)) : old('waktu_selesai') }}" required>
                            @if($errors->has('waktu_selesai'))
                            <span class="help-block">
                                <strong>{{ $errors->first('waktu_selesai') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Nama Kegiatan</strong></label>
                    <input type="text" name="nama_agenda" class="form-control input-sm" value="{{ isset($agenda) ? $agenda->nama_agenda : old('nama_agenda') }}" required>
                    @if($errors->has('nama_agenda'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nama_agenda') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>Tempat Kegiatan</strong></label>
                    <input type="text" name="tempat" class="form-control input-sm" value="{{ isset($agenda) ? $agenda->tempat : old('tempat') }}" required>
                    @if($errors->has('tempat'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tempat') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>Deskripsi Agenda</strong></label>
                    <textarea name="deskripsi" class="form-control input-sm" rows="3" required>{!! isset($agenda) ? $agenda->deskripsi : old('deskripsi') !!}</textarea>
                    @if($errors->has('deskripsi'))
                    <span class="help-block">
                        <strong>{{ $errors->first('deskripsi') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-default btn-fill btn-md btn-space" name="simpan" value="simpan">Simpan</button>
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-space" name="simpan" value="simpanandnext">Simpan dan Buat agenda baru</button>
            </div>
        </form>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
