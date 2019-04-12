@extends('layouts.adminnopadding')

@section('title')
Kelola Ujian
@endsection

@section('description')
{{ $ujian->judul }} {!! $ujian->is_published == 0 ? "<small class='text-muted'>[Draft]</small>" : "" !!}
@endsection

@section('navigation')
    @include('adminujian.ujian.menu', ['jumlahSoal' => $ujian->soal->count(), 'jumlahPeserta' => $ujian->diBeliOleh->count(), 'jumlahRiwayat' => $ujian->attempt->count()])
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-6">
            <div class="email-title">
                <span class="icon mdi mdi-inbox mr-3"></span> Soal-soal
            </div>
            <div>
                @if($ujian->is_grouped)
                Ujian ini memiliki model soal yang berkelompok.
                @else
                Ujian ini memiliki model soal biasa.
                @endif
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>
<div class="panel no-border no-radius {{ $ujian->is_grouped ? 'mb-5' : 'mb-0' }}">
    <div class="panel-body">
        @if(!$ujian->is_published)
            @if($ujian->is_grouped)
            <a href="{{ route('admin.ujian.soal.form.kelompok.soal.get', $ujian->id) }}" class="btn btn-default btn-md btn-icon btn-hspace btn-rounded"><i class="mdi mdi-plus"></i>Tambah Kelompok Soal Ujian</a>
            @else
            <a href="{{ route('admin.ujian.soal.form.soal', $ujian->id) }}" class="btn btn-default btn-md btn-icon btn-hspace btn-rounded"><i class="mdi mdi-plus"></i>Tambah Soal</a>
            <button type="button" class="btn btn-default btn-md btn-icon btn-hspace btn-rounded" data-toggle="modal" data-target="#modalImportSoal"><i class="mdi mdi-download"></i>Import Soal</button>
            @endif
        @endif
        <a href="{{ route('admin.ujian.soal.view', $ujian->id) }}" target="_blank" class="btn btn-md btn-primary btn-rounded pull-right"><i class="mdi mdi-eye mr-3"></i>Review Soal</a>
    </div>
</div>
@if($ujian->is_grouped)
    @if($ujian->group->count() <= 0)
    <div class="panel no-border no-radius">
        <div class="panel-body">
            <div class="data-is-empty">
                <p><i class="mdi mdi-close-circle"></i></p>
                <p>KELOMPOK SOAL BELUM DIBUAT</p>
                @if($ujian->is_published != 1)
                <a href="{{ route('admin.ujian.soal.form.kelompok.soal.get', $ujian->id) }}" class="btn btn-default">BUAT KELOMPOK SOAL BARU</a>
                @endif
            </div>
        </div>
    </div>
    @endif
    @foreach($ujian->group as $group)
    <div class="panel panel-default panel-table no-border no-radius" style="border: none">
        <div class="panel-body">
            <table class="table table-striped table-borderedless">
                <thead>
                    <tr>
                        <td colspan="8">
                            <strong class="mr-5">{{ $group->nama }}</strong>
                            <strong><i class="mdi mdi-timer mr-2"></i>Durasi</strong> : <span>{{ floor($group->durasi/60) }} menit {{ $group->durasi%60 }} detik</span>
                            @if(!$ujian->is_published)
                            <a href="{{ route('admin.ujian.soal.form.kelompok.soal.get', ['id' => $ujian->id, 'idKelompokSoal' => $group->id]) }}" class="ml-5 pull-right hover-underline" style="font-weight: 400"><i class="mdi mdi-edit mr-2"></i>Ubah</a>
                            <a href="{{ route('admin.ujian.soal.delete.kelompok.soal', ['id' => $ujian->id, 'idKelompokSoal' => $group->id]) }}" class="ml-5 pull-right hover-underline text-danger delete" style="font-weight: 400"><i class="mdi mdi-delete mr-2"></i>Hapus</a>
                            <a href="{{ route('admin.ujian.soal.form.soal', ['id' => $ujian->id])."?idKelompokSoal=".$group->id }}" class="mr-5 pull-right btn btn-xs btn-default"><i class="mdi mdi-plus mr-2"></i> TAMBAH SOAL</a>
                            @endif
                        </td>
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
                                    @if($ujian->is_published != 1)
                                    <a href="{{ route('admin.ujian.soal.form.soal', ['id' => $ujian->id])."?idKelompokSoal=".$group->id }}" class="btn btn-default btn-rounded">BUAT SOAL BARU</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @else
                    @foreach($group->soal as $i => $data)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td><div class="list-soal-in-table">{!! $data->soal !!}</div></td>
                        <td class="text-center">{!! $data->jawaban == 'a' ? "<strong class='label label-primary'>A</strong>" : "<span class='text-muted'>A</span>" !!}</td>
                        <td class="text-center">{!! $data->jawaban == 'b' ? "<strong class='label label-primary'>B</strong>" : "<span class='text-muted'>B</span>" !!}</td>
                        <td class="text-center">{!! $data->jawaban == 'c' ? "<strong class='label label-primary'>C</strong>" : "<span class='text-muted'>C</span>" !!}</td>
                        <td class="text-center">{!! $data->jawaban == 'd' ? "<strong class='label label-primary'>D</strong>" : "<span class='text-muted'>D</span>" !!}</td>
                        <td class="text-center">{!! $data->jawaban == 'e' ? "<strong class='label label-primary'>E</strong>" : "<span class='text-muted'>E</span>" !!}</td>
                        <td class="text-center" class="text-center">
                            <a href="{{ route('admin.ujian.soal.form.soal', ['id' => $ujian->id, 'idSoal' => $data->id]) }}" class="btn btn-xs btn-warning"><i class="mdi mdi-edit"></i></a>
                            @if(!$ujian->is_published)
                            <a href="{{ route('admin.ujian.soal.delete.soal', ['id' => $ujian->id, 'idSoal' => $data->id]) }}" class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
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
<div class="panel panel-default panel-table mb-0" style="border: none">
    <div class="panel-body">
        <table class="table table-striped table-borderless">
            <thead>
                <tr>
                    <th class="text-valign-center" width="1px">NO</th>
                    <th class="text-valign-center" rowspan="2">SOAL</th>
                    <th class="text-valign-center" width="50px">A</th>
                    <th class="text-valign-center" width="50px">B</th>
                    <th class="text-valign-center" width="50px">C</th>
                    <th class="text-valign-center" width="50px">D</th>
                    <th class="text-valign-center" width="50px">E</th>
                    <th class="text-valign-center" width="100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($ujian->soal->count() <= 0)
                    <tr>
                        <td colspan="8">
                            <div class="data-is-empty">
                                <p><i class="mdi mdi-close-circle"></i></p>
                                <p>SOAL BELUM ADA</p>
                                <a href="{{ route('admin.ujian.soal.form.soal', $ujian->id) }}" class="btn btn-default btn-rounded">BUAT SOAL BARU</a>
                            </div>
                        </td>
                    </tr>
                @else
                @foreach($ujian->soal as $i => $data)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td><div class="list-soal-in-table">{!! $data->soal !!}</div></td>
                    <td class="text-center">{!! $data->jawaban == 'a' ? "<strong class='label label-primary'>A</strong>" : "<span class='text-muted'>A</span>" !!}</td>
                    <td class="text-center">{!! $data->jawaban == 'b' ? "<strong class='label label-primary'>B</strong>" : "<span class='text-muted'>B</span>" !!}</td>
                    <td class="text-center">{!! $data->jawaban == 'c' ? "<strong class='label label-primary'>C</strong>" : "<span class='text-muted'>C</span>" !!}</td>
                    <td class="text-center">{!! $data->jawaban == 'd' ? "<strong class='label label-primary'>D</strong>" : "<span class='text-muted'>D</span>" !!}</td>
                    <td class="text-center">{!! $data->jawaban == 'e' ? "<strong class='label label-primary'>E</strong>" : "<span class='text-muted'>E</span>" !!}</td>
                    <td class="text-center" class="text-center">
                        <a href="{{ route('admin.ujian.soal.form.soal', ['id' => $ujian->id, 'idSoal' => $data->id]) }}" class="btn btn-xs btn-rounded btn-warning"><i class="mdi mdi-edit"></i></a>
                        @if(!$ujian->is_published)
                        <a href="{{ route('admin.ujian.soal.delete.soal', ['id' => $ujian->id, 'idSoal' => $data->id]) }}" class="btn btn-xs btn-rounded btn-danger delete"><i class="mdi mdi-delete"></i></a>
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

<div class="modal fade" id="modalImportSoal" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                    <h4 class="modal-title" id="modalFormLabel">Import Soal</h4>
                </div>
                <form class="modal-body" action="{{ route('admin.ujian.soal.import.soal.post', $ujian->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Import Menggunakan Aiken Format</label> <br>
                        <input type="hidden" name="featured_image">
                        <input class="inputfile" id="file" type="file" name="file" data-multiple-caption="{count} files selected" required>
                        <label class="btn-secondary" for="file"> <i class="mdi mdi-upload"></i><span>Pilih File</span></label>                            
                        @if($errors->has('featured_image'))
                        <span class="help-block">
                            <strong>{{ $errors->first('featured_image') }}</strong>
                        </span> @endif
                    </div>
                    <button type="submit" id="btnSubmit" class="btn btn-primary btn-block btn-sm">Import Soal</button>
                </form>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-fill btn-md" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
