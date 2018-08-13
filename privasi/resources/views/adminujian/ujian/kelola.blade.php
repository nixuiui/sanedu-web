@extends('layouts.admin')

@section('title')
Kelola Soal Ujian
@endsection

@section('content')
<div class="alert alert-{{ $ujian->is_published ? "success" : "primary" }} alert-icon alert-icon-border alert-dismissible" role="alert">
    <div class="icon"><span class="mdi mdi-mail-send"></span></div>
    <div class="message">
        <strong>{{ $ujian->is_published ? "Soal Sudah di Publish" : "Publish Soal Ujian!" }}</strong>
        <p>Soal Ujian yang sudah di publish sudah tidak bisa lagi untuk menambah, mengubah, atau menghapus butir soal.</p>
        @if(!$ujian->is_published)
        <a href="{{ route('admin.ujian.soal.publish', $ujian->id) }}" class="btn btn-primary btn-md">Publish Sekarang</a>
        @else
            @if( $ujian->diBeliOleh->count() > 0)
            <hr>
            <p>Soal ini sudah dibeli oleh <strong><a href="{{ route('admin.ujian.soal.pembeli', $ujian->id) }}">{{ $ujian->diBeliOleh->count() }}x</a></strong> oleh member, <strong><a href="{{ route('admin.ujian.soal.pembeli', $ujian->id) }}">Lihat Member yang membeli</a></strong></p>
            @else
            <p class="">Soal belum ada yang membeli. :(</p>
            @endif
            @if( $ujian->attempt->count() > 0)
            <p>Soal ini sudah dikerjakan <strong><a href="{{ route('admin.ujian.soal.history', $ujian->id) }}">{{ $ujian->attempt->count() }}x</a></strong> oleh member, <strong><a href="{{ route('admin.ujian.soal.history', $ujian->id) }}">Lihat history</a></strong></p>
            @else
            <p class="">Soal belum ada yang mengerjakan.</p>
            @endif
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="panel panel-default" action="{{ route('admin.ujian.soal.edit.post', $ujian->id) }}" method="post">
            <div class="panel-heading">Form Ujian</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tingkat Sekolah</label>
                            <input type="text" class="form-control input-sm" value="{{ $ujian->tingkatSekolah->nama }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Ujian</label>
                            <input type="text" class="form-control input-sm" value="{{ $ujian->jenisUjian->nama }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" class="form-control input-sm" value="{{ $ujian->id_tingkat_kelas != null ? $ujian->tingkatKelas->nama : '-'}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Mata Ujian</label>
                            <input type="text" class="form-control input-sm" value="{{ $ujian->id_mata_pelajaran != null ? $ujian->mataPelajaran->nama : '-'}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Judul Ujian</label>
                            <input type="text" class="form-control input-sm" placeholder="Ujian Nasional SMA Matematika" name="judul"  value="{{ $ujian->judul }}" required>
                            @if($errors->has('judul'))
                            <span class="help-block">
                                <strong>{{ $errors->first('judul') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" class="form-control input-sm" placeholder="1000" name="harga"  value="{{ $ujian->harga }}" required>
                            @if($errors->has('harga'))
                            <span class="help-block">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Link Pembahasan</label>
                            <input type="url" class="form-control input-sm" placeholder="http://www.domain.com/filepembahasan" name="url"  value="{{ $ujian->link_pembahasan }}">
                            @if($errors->has('url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Durasi (menit)</label>
                            <input type="number" class="form-control input-sm" placeholder="60" name="durasi"  value="{{ $ujian->durasi }}" required>
                            @if($errors->has('durasi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('durasi') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-icon"><i class="mdi mdi-check"></i>Simpan Perubahan</button>
                <a href="{{ route('admin.ujian.form.peraturan', $ujian->id) }}" class="btn btn-default btn-md btn-icon pull-right"><i class="mdi mdi-settings"></i>{{ $ujian->peraturan == null ? "Peraturan Ujian Belum Ada" : "Peraturan Ujian"}}</a>
            </div>
        </form>

        @if(!$ujian->is_published)
        <a href="{{ route('admin.ujian.soal.form.soal', $ujian->id) }}" class="btn btn-warning btn-md btn-icon btn-space"><i class="mdi mdi-plus"></i>Tambah Soal</a>
        @endif
        <div class="panel panel-default panel-table" style="border: none">
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-valign-center" rowspan="2" width="1px">NO</th>
                            <th class="text-valign-center" rowspan="2">SOAL</th>
                            <th class="text-valign-center" colspan="5">JAWABAN</th>
                            <th class="text-valign-center" rowspan="2" width="100px">Aksi</th>
                        </tr>
                        <tr>
                            <th class="text-valign-center" width="50px">A</th>
                            <th class="text-valign-center" width="50px">B</th>
                            <th class="text-valign-center" width="50px">C</th>
                            <th class="text-valign-center" width="50px">D</th>
                            <th class="text-valign-center" width="50px">E</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($soal->count() <= 0)
                            <tr>
                                <td colspan="8">
                                    <div class="data-is-empty">
                                        <i class="mdi mdi-close-circle"></i>
                                        SOAL BELUM ADA <br>
                                        <a href="{{ route('admin.ujian.soal.form.soal', $ujian->id) }}">BUAT SOAL BARU</a>
                                    </div>
                                </td>
                            </tr>
                        @else
                        @foreach($soal as $i => $data)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td><div class="list-soal-in-table">{!! $data->soal !!}</div></td>
                            <td class="text-center">{!! $data->jawaban == 'a' ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                            <td class="text-center">{!! $data->jawaban == 'b' ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                            <td class="text-center">{!! $data->jawaban == 'c' ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                            <td class="text-center">{!! $data->jawaban == 'd' ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                            <td class="text-center">{!! $data->jawaban == 'e' ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                            <td class="text-center" class="text-center">
                                @if(!$ujian->is_published)
                                <a href="{{ route('admin.ujian.soal.form.soal', ['id' => $ujian->id, 'idSoal' => $data->id]) }}" class="btn btn-xs btn-warning"><i class="mdi mdi-edit"></i></a>
                                <a href="{{ route('admin.ujian.soal.delete.soal', ['id' => $ujian->id, 'idSoal' => $data->id]) }}" class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
                                @else
                                <a href="{{ route('admin.ujian.soal.lihat.soal', ['id' => $ujian->id, 'idSoal' => $data->id]) }}" class="btn btn-xs btn-default"><i class="mdi mdi-eye"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
