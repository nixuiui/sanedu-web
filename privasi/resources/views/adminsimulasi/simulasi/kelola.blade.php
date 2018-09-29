@extends('layouts.admin')

@section('title')
Kelola Soal Ujian
@endsection

@section('content')
<div class="alert alert-{{ $simulasi->is_published ? "success" : "primary" }} alert-icon alert-icon-border alert-dismissible" role="alert">
    <div class="icon"><span class="mdi mdi-mail-send"></span></div>
    <div class="message">
        @if(!$simulasi->is_published)
        <a href="{{ route('adminsimulasi.simulasi.kelola.publish', $simulasi->id) }}" class="btn btn-primary btn-md">Publish Sekarang</a>
        @else
            @if( $simulasi->peserta->count() > 0)
            <p>Jumlah peserta yang mendaftar pada simulasi ini adalah <strong><a href="{{ route('admin.ujian.soal.pembeli', $simulasi->id) }}">{{ $simulasi->peserta->count() }}</a></strong> peserta, <strong><a href="{{ route('admin.ujian.soal.pembeli', $simulasi->id) }}">Lihat peserta</a></strong></p>
            @else
            <p class="">Belum ada peserta yang mendaftar pada simulasi ini.</p>
            @endif
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.edit.post', $simulasi->id) }}" method="post">
            <div class="panel-heading">Form Ujian</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tingkat Sekolah</label>
                            <input type="text" class="form-control input-sm" value="{{ $simulasi->tingkatSekolah->nama }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Judul Ujian Simulasi</label>
                            <input type="text" class="form-control input-sm" placeholder="Ujian Nasional SMA Matematika" name="judul"  value="{{ $simulasi->judul }}" required>
                            @if($errors->has('judul'))
                            <span class="help-block">
                                <strong>{{ $errors->first('judul') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Instansi Penyelenggara</label>
                            <input type="text" class="form-control input-sm" placeholder="Study & Fun" name="instansi"  value="{{ $simulasi->instansi }}" required>
                            @if($errors->has('instansi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('instansi') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" class="form-control input-sm" placeholder="1000" name="harga"  value="{{ $simulasi->harga }}" required>
                            @if($errors->has('harga'))
                            <span class="help-block">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tempat Pelaksanaan</label>
                            <input type="text" class="form-control input-sm" placeholder="Unila" name="tempat_pelaksanaan"  value="{{ $simulasi->tempat_pelaksanaan }}">
                            @if($errors->has('tempat_pelaksanaan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tempat_pelaksanaan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tanggal Pelaksanaan</label>
                            <input type="date" class="form-control input-sm" placeholder="60" name="tanggal_pelaksanaan"  value="{{ $simulasi->tanggal_pelaksanaan }}" required>
                            @if($errors->has('tanggal_pelaksanaan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tanggal_pelaksanaan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-icon"><i class="mdi mdi-check"></i>Simpan Perubahan</button>
            </div>
        </form>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('adminsimulasi.simulasi.kelola.agenda.form', $simulasi->id) }}" class="btn btn-warning btn-md btn-icon btn-space"><i class="mdi mdi-plus"></i>Tambah Kegiatan</a>

                <div class="panel panel-default panel-table">
                    <div class="panel-body">
                        <table id="datatables" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Agenda</th>
                                    <th>Deskripsi</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($simulasi->agenda->count() > 0)
                                @foreach($simulasi->agenda as $agenda)
                                <tr>
                                    <td>{{ hariTanggalWaktu($agenda->waktu) }}</td>
                                    <td>{{ $agenda->nama_agenda }}</td>
                                    <td>{{ $agenda->deskripsi }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('adminsimulasi.simulasi.kelola.agenda.form', ['id' => $simulasi->id, 'idAgenda' => $agenda->id]) }}" class="btn btn-md btn-success" title="Edit Agenda"><i class="mdi mdi-edit"></i></a>
                                        <a href="{{ route('adminsimulasi.simulasi.kelola.agenda.delete', ['id' => $simulasi->id, 'idAgenda' => $agenda->id]) }}" class="btn btn-md btn-danger delete" title="Hapus Agenda"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="data-is-empty">Belum ada agenda yang dibuat</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
