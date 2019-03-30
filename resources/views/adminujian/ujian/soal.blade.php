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
            <a href="{{ route('admin.ujian.soal.view', $ujian->id) }}" target="_blank" class="btn btn-md btn-primary btn-rounded pull-right"><i class="mdi mdi-eye mr-3"></i>Review Soal</a>
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
            @endif
        @endif
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
                            <a href="{{ route('admin.ujian.soal.delete.kelompok.soal', ['id' => $ujian->id, 'idKelompokSoal' => $group->id]) }}" class="ml-5 pull-right hover-underline text-danger delete" style="font-weight: 400"><i class="mdi mdi-delete mr-2"></i>Hapus</a>
                            <a href="{{ route('admin.ujian.soal.form.kelompok.soal.get', ['id' => $ujian->id, 'idKelompokSoal' => $group->id]) }}" class="ml-5 pull-right hover-underline" style="font-weight: 400"><i class="mdi mdi-edit mr-2"></i>Ubah</a>
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
                        <td class="text-center">{!! $data->jawaban == 'a' ? "<i class='mdi mdi-circle text-success'></i>" : "" !!}</td>
                        <td class="text-center">{!! $data->jawaban == 'b' ? "<i class='mdi mdi-circle text-success'></i>" : "" !!}</td>
                        <td class="text-center">{!! $data->jawaban == 'c' ? "<i class='mdi mdi-circle text-success'></i>" : "" !!}</td>
                        <td class="text-center">{!! $data->jawaban == 'd' ? "<i class='mdi mdi-circle text-success'></i>" : "" !!}</td>
                        <td class="text-center">{!! $data->jawaban == 'e' ? "<i class='mdi mdi-circle text-success'></i>" : "" !!}</td>
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
                    <td class="text-center">{!! $data->jawaban == 'a' ? "<i class='mdi mdi-circle text-success'></i>" : "" !!}</td>
                    <td class="text-center">{!! $data->jawaban == 'b' ? "<i class='mdi mdi-circle text-success'></i>" : "" !!}</td>
                    <td class="text-center">{!! $data->jawaban == 'c' ? "<i class='mdi mdi-circle text-success'></i>" : "" !!}</td>
                    <td class="text-center">{!! $data->jawaban == 'd' ? "<i class='mdi mdi-circle text-success'></i>" : "" !!}</td>
                    <td class="text-center">{!! $data->jawaban == 'e' ? "<i class='mdi mdi-circle text-success'></i>" : "" !!}</td>
                    <td class="text-center" class="text-center">
                        @if(!$ujian->is_published)
                        <a href="{{ route('admin.ujian.soal.form.soal', ['id' => $ujian->id, 'idSoal' => $data->id]) }}" class="btn btn-xs btn-rounded btn-warning"><i class="mdi mdi-edit"></i></a>
                        <a href="{{ route('admin.ujian.soal.delete.soal', ['id' => $ujian->id, 'idSoal' => $data->id]) }}" class="btn btn-xs btn-rounded btn-danger delete"><i class="mdi mdi-delete"></i></a>
                        @else
                        <a href="{{ route('admin.ujian.soal.lihat.soal', ['id' => $ujian->id, 'idSoal' => $data->id]) }}" class="btn btn-xs btn-rounded btn-default"><i class="mdi mdi-eye"></i></a>
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
@endsection

@section('script')
@endsection
