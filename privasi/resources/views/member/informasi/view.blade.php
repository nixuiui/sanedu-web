@extends('layouts.admin')

@section('title')
{{ $informasi->judul }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <img class="card-img-top" src="{{ $informasi->foto_url }}" alt="Placeholder" style="height: 300px;">
            <div class="card-header">{{ $informasi->judul }}</div>
            <div class="card-body">
                <p>{!! $informasi->isi !!}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h3 style="margin:0; padding-bottom: 25px; font-weight: 600">Informasi Lainnya</h3>
        @foreach($other as $info)
        <div class="card mb-3">
            <img class="card-img-top" src="{{ $info->foto_url }}" alt="Placeholder">
            <div class="card-header">{{ $info->judul }}</div>
            <div class="card-body">
                <a class="card-link" href="{{ route('member.informasi.view', $info->id) }}">Baca Selengkapnya</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
