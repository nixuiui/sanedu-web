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
            <hr>
            <p>Tanggal Rilis: {{ hariTanggalWaktu($ujian->created_at) }}</p>
            @if( $ujian->diBeliOleh->count() > 0)
            <p>Soal ini sudah dibeli oleh <strong><a href="{{ route('admin.ujian.soal.peserta', $ujian->id) }}">{{ $ujian->diBeliOleh->count() }}x</a></strong> oleh member, <strong><a href="{{ route('admin.ujian.soal.peserta', $ujian->id) }}">Lihat Member yang membeli</a></strong></p>
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
                    @if(!$ujian->is_grouped)
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Durasi (menit)</label>
                                    <input type="number" class="form-control input-sm" placeholder="60" name="menit"  value="{{ floor($ujian->durasi/60) }}" required>
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
                                    <input type="number" class="form-control input-sm" placeholder="60" name="detik"  value="{{ ($ujian->durasi%60) }}" required>
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
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-icon btn-hspace"><i class="mdi mdi-check"></i>Simpan Perubahan</button>
                <a href="{{ route('admin.ujian.soal.up', $ujian->id) }}" class="btn btn-default btn-fill btn-md btn-icon btn-hspace"><i class="mdi mdi-long-arrow-up"></i>Naikan Soal</a>
                <a href="{{ route('admin.ujian.form.peraturan', $ujian->id) }}" class="btn btn-default btn-md btn-icon pull-right"><i class="mdi mdi-settings"></i>{{ $ujian->peraturan == null ? "Peraturan Ujian Belum Ada" : "Peraturan Ujian"}}</a>
            </div>
        </form>

        @if(!$ujian->is_published)
            @if($ujian->is_grouped)
            <a href="{{ route('admin.ujian.soal.form.kelompok.soal.get', $ujian->id) }}" class="btn btn-success btn-md btn-icon btn-space"><i class="mdi mdi-plus"></i>Tambah Kelompok Soal Ujian</a>
            @else
            <a href="{{ route('admin.ujian.soal.form.soal', $ujian->id) }}" class="btn btn-success btn-md btn-icon btn-space"><i class="mdi mdi-plus"></i>Tambah Soal</a>
            @endif
        @endif
        <a href="{{ route('admin.ujian.soal.view', $ujian->id) }}" class="btn btn-default btn-md btn-icon btn-space"><i class="mdi mdi-eye"></i>Review Soal</a>
            
        @if($ujian->is_grouped)
            @if($ujian->group->count() <= 0)
            <div class="panel">
                <div class="panel-body">
                    <div class="data-is-empty">
                        <p><i class="mdi mdi-close-circle"></i></p>
                        <p>KELOMPOK SOAL BELUM DIBUAT</p>
                        <a href="{{ route('admin.ujian.soal.form.kelompok.soal.get', $ujian->id) }}" class="btn btn-default">BUAT KELOMPOK SOAL BARU</a>
                    </div>
                </div>
            </div>
            @endif
            @foreach($ujian->group as $group)
            <div class="panel panel-default panel-table" style="border: none">
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    {{ $group->nama }}
                                    @if(!$ujian->is_published)
                                    <a href="{{ route('admin.ujian.soal.form.soal', ['id' => $ujian->id])."?idKelompokSoal=".$group->id }}" class="pull-right mr-5">+ Tambah Soal</a>
                                    <a href="{{ route('admin.ujian.soal.form.kelompok.soal.get', ['id' => $ujian->id, 'idKelompokSoal' => $group->id]) }}" class="ml-3" style="font-weight: 400">Ubah</a>
                                    <a href="{{ route('admin.ujian.soal.delete.kelompok.soal', ['id' => $ujian->id, 'idKelompokSoal' => $group->id]) }}" class="ml-3 text-danger delete" style="font-weight: 400">Hapus</a>
                                    @endif
                                </th>
                                <th colspan="6">DURASI : <span>{{ floor($group->durasi/60) }} menit {{ $group->durasi%60 }} detik</span></th>
                            </tr>
                            <tr>
                                <th class="text-valign-center" width="1px">NO</th>
                                <th class="text-valign-center">SOAL</th>
                                <th class="text-valign-center" width="50px">A</th>
                                <th class="text-valign-center" width="50px">B</th>
                                <th class="text-valign-center" width="50px">C</th>
                                <th class="text-valign-center" width="50px">D</th>
                                <th class="text-valign-center" width="50px">E</th>
                                <th class="text-valign-center" width="100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($group->soal->count() <= 0)
                                <tr>
                                    <td colspan="8">
                                        <div class="data-is-empty">
                                            <p><i class="mdi mdi-close-circle"></i></p>
                                            <p>SOAL BELUM ADA</p>
                                            <a href="{{ route('admin.ujian.soal.form.soal', $ujian->id) }}" class="btn btn-default">BUAT SOAL BARU</a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                            @foreach($group->soal as $i => $data)
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
            @endforeach
        @else
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
                        @if($ujian->soal->count() <= 0)
                            <tr>
                                <td colspan="8">
                                    <div class="data-is-empty">
                                        <p><i class="mdi mdi-close-circle"></i></p>
                                        <p>SOAL BELUM ADA</p>
                                        <a href="{{ route('admin.ujian.soal.form.soal', $ujian->id) }}" class="btn btn-default">BUAT SOAL BARU</a>
                                    </div>
                                </td>
                            </tr>
                        @else
                        @foreach($ujian->soal as $i => $data)
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
        @endif
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
