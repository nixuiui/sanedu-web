@extends('layouts.admin')

@section('title')
Jadwal Online
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-md-6">
        @if(isset($jadwal))
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.jadwal.post', ['id' => $simulasi->id, 'idJadwal' => $jadwal->id]) }}" method="post">
        @else
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.jadwal.post', $simulasi->id) }}" method="post">
        @endif
            <div class="panel-heading">
                Form Jadwal Online
            </div>
            <div class="panel-body">
                @csrf
                <div class="form-group">
                    <label><strong>Tanggal</strong></label>
                    <input type="date" name="tanggal" class="form-control input-sm" value="{{ isset($jadwal) ? date('H:i', strtotime($jadwal->tanggal)) : old('tanggal') }}" required>
                    @if($errors->has('tanggal'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tanggal') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label><strong>Kapasistas</strong></label>
                    <input type="number" name="kapasitas" class="form-control input-sm" value="{{ isset($jadwal) ? $jadwal->kapasitas : old('kapasitas') }}" placeholder="0" required>
                    @if($errors->has('kapasitas'))
                    <span class="help-block">
                        <strong>{{ $errors->first('kapasitas') }}</strong>
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
