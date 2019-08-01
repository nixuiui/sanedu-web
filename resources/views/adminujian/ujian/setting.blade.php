@extends('layouts.adminnopadding')

@section('title')
Kelola Ujian
@endsection

@section('description')
{{ $ujian->judul }}
@endsection

@section('navigation')
    @include('adminujian.ujian.menu', ['jumlahSoal' => $ujian->soal->count(), 'jumlahPeserta' => $ujian->diBeliOleh->count(), 'jumlahRiwayat' => $ujian->attempt->count()])
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-settings mr-3"></span> Pengaturan Ujian
            </div>
        </div>
    </div>
</div>

<form class="panel panel-default no-border no-radius" action="{{ route('admin.ujian.soal.edit.post', $ujian->id) }}" method="post">
    <div class="panel-body pb-5">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Judul Ujian</label>
                            <input type="text" class="form-control input-md" placeholder="Ujian Nasional SMA Matematika" name="judul"  value="{{ $ujian->judul }}" required>
                            @if($errors->has('judul'))
                            <span class="help-block">
                                <strong>{{ $errors->first('judul') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tingkat Sekolah</label>
                            <input type="text" class="form-control input-md" value="{{ $ujian->tingkatSekolah->nama }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ujian</label>
                            <input type="text" class="form-control input-md" value="{{ $ujian->jenisUjian->nama }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" class="form-control input-md" value="{{ $ujian->id_tingkat_kelas != null ? $ujian->tingkatKelas->nama : '-'}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mata Ujian</label>
                            <input type="text" class="form-control input-md" value="{{ $ujian->id_mata_pelajaran != null ? $ujian->mataPelajaran->nama : '-'}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" class="form-control input-md" placeholder="1000" name="harga"  value="{{ $ujian->harga }}" required>
                            @if($errors->has('harga'))
                            <span class="help-block">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link Pembahasan</label>
                            <input type="url" class="form-control input-md" placeholder="http://www.domain.com/filepembahasan" name="url"  value="{{ $ujian->link_pembahasan }}">
                            @if($errors->has('url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    @if(!$ujian->is_grouped)
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Durasi (menit)</label>
                                    <input type="number" class="form-control input-md" placeholder="60" name="menit"  value="{{ floor($ujian->durasi/60) }}" required>
                                    @if($errors->has('menit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('menit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>(detik)</label>
                                    <input type="number" class="form-control input-md" placeholder="60" name="detik"  value="{{ ($ujian->durasi%60) }}" required>
                                    @if($errors->has('detik'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('detik') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-lg btn-icon btn-hspace"><i class="mdi mdi-check mr-3"></i>Simpan Perubahan</button>
                <a href="{{ route('admin.ujian.soal.up', $ujian->id) }}" class="btn btn-default btn-fill btn-lg btn-icon btn-hspace"><i class="mdi mdi-long-arrow-up mr-3"></i>Naikan Soal</a>
                <a href="{{ route('admin.ujian.form.peraturan', $ujian->id) }}" class="btn btn-default btn-lg btn-icon pull-right"><i class="mdi mdi-settings mr-3"></i>{{ $ujian->peraturan == null ? "Peraturan Ujian Belum Ada" : "Peraturan Ujian"}}</a>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
@endsection
