@extends('layouts.admin')

@section('title')
Jadwal Online
@endsection

@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', $simulasi->id) }}" class="btn btn-md btn-default btn-space"><i class="mdi mdi-arrow-left"></i> Kembali</a>
<div class="row">
    @if(!isset($_GET['no_peserta']))
    <div class="col-md-4">
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.peserta.online.form', $simulasi->id) }}" method="get">
            <div class="panel-heading">
                Form Penempatan Peserta Online
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label><strong>Nomor Peserta</strong></label>
                    <input type="text" name="no_peserta" class="form-control input-sm" placeholder="111-24-00000" required>
                    @if($errors->has('no_peserta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('no_peserta') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Cari Peserta</button>
            </div>
        </form>
    </div>
    @else
    <div class="col-md-6">
        <div class="panel panel-table">
            <div class="panel-heading">
                FORM
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No Peserta</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peserta as $data)
                        <tr>
                            <form class=""<form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.peserta.online.post', $simulasi->id) }}" method="post">
                                <td>{{ $data->no_peserta }}</td>
                                <td>{{ $data->profil->nama }}</td>
                                <td>
                                    @csrf
                                    <input type="hidden" name="id_peserta" value="{{ $data->id }}">
                                    <select class="form-control input-xs" name="id_jadwal_online" required>
                                        <option value="">-- Pilih Jadwal Online --</option>
                                        @foreach($jadwal as $j)
                                        <option value="{{ $j->id }}" {{ $data->id_jadwal_online == $j->id ? "selected" : ""  }}>{{ hariTanggal($j->tanggal) }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('id_jadwal_online'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_jadwal_online') }}</strong>
                                    </span>
                                    @endif
                                </td>
                                <td class="text-right"><button type="submit" class="btn btn-primary btn-md">Simpan</button></td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.kelola.peserta.online.form', $simulasi->id) }}" method="get">
            <div class="panel-heading">
                Form Penempatan Peserta Online
            </div>
            <div class="panel-body">
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
                    <label><strong>Nomor Peserta</strong></label>
                    <input type="text" name="no_peserta" class="form-control input-sm" placeholder="111-24-00000" required>
                    @if($errors->has('no_peserta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('no_peserta') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md">Cari Peserta</button>
            </div>
        </form>
    </div>
    @endif
</div> <!-- end row -->
@endsection

@section('script')
@endsection
