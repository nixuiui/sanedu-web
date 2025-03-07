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
                <span class="icon mdi mdi-inbox mr-3"></span> Analitik Soal
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>
<div class="panel no-border no-radius mb-0">
    <div class="panel-body">
        <a href="{{ route('admin.ujian.soal.analisis', $ujian->id) }}" class="btn btn-md btn-primary btn-rounded pull-right"><i class="mdi mdi-eye mr-3"></i>Analisis Soal</a>
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
                <a href="{{ route('admin.ujian.soal.analisis', $ujian->id) }}" class="btn btn-default">Analisis Soal</a>
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
                        <th class="text-valign-center" width="1px">NO</th>
                        <th class="text-valign-center" rowspan="2" width="600px">SOAL</th>
                        <th class="text-valign-left" width="50px" colspan="3">Benar</th>
                        <th class="text-right" width="50px" colspan="3">Salah</th>
                        <th class="text-valign-center" width="100px"></th>
                    </tr>
                </thead>
                <tbody>
                    @if($group->soal->count() <= 0)
                        <tr>
                            <td colspan="9">
                                <div class="data-is-empty">
                                    <p><i class="mdi mdi-close-circle"></i></p>
                                    <p>SOAL BELUM DIANALISIS</p>
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
                        <td class="milestone" colspan="6">
                            <span class="completed"><strong>{{ $data->jumlah_salah }}</strong></span>
                            <span class="version">{{ $data->jumlah_benar }}</span>
                            <div class="progress">
                                <div style="width: {{ ($data->jumlah_benar+$data->jumlah_salah > 0) ? ($data->jumlah_benar/($data->jumlah_benar+$data->jumlah_salah))*100 : 0}}%" class="progress-bar progress-bar-primary"></div>
                            </div>
                        </td>
                        <td class="text-center" class="text-center">
                            {{ $data->kriteria }}
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
                    <th class="text-valign-center" rowspan="2" width="600px">SOAL</th>
                    <th class="text-valign-left" width="50px" colspan="3">Benar</th>
                    <th class="text-right" width="50px" colspan="3">Salah</th>
                    <th class="text-valign-center" width="100px"></th>
                </tr>
            </thead>
            <tbody>
                @if($ujian->soal->count() <= 0)
                    <tr>
                        <td colspan="9">
                            <div class="data-is-empty">
                                <p><i class="mdi mdi-close-circle"></i></p>
                                <p>SOAL BELUM DIANALISIS</p>
                                <a href="{{ route('admin.ujian.soal.analisis', $ujian->id) }}" class="btn btn-default btn-rounded">Analisis Soal</a>
                            </div>
                        </td>
                    </tr>
                @else
                @foreach($ujian->soal as $i => $data)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td><div class="list-soal-in-table">{!! $data->soal !!}</div></td>
                    <td class="milestone" colspan="6">
                        <span class="completed"><strong>{{ $data->jumlah_salah }}</strong></span>
                        <span class="version">{{ $data->jumlah_benar }}</span>
                        <div class="progress">
                            <div style="width: {{ ($data->jumlah_benar+$data->jumlah_salah > 0) ? ($data->jumlah_benar/($data->jumlah_benar+$data->jumlah_salah))*100 : 0 }}%" class="progress-bar progress-bar-primary"></div>
                        </div>
                    </td>
                    <td class="text-center" class="text-center">
                        {{ $data->kriteria }}
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
