@extends('layouts.admin')

@section('title')
Join Grup Chat
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            @if($wa == null)
            <div class="panel-body">
                @if($grupWa->count() <= 0)
                <a href="#" class="btn btn-default btn-md disabled"><img src="{{ asset('asset-beagle/img/whatsapp.png') }}" style="width: 20px; margin-right: 5px"> Grup WhatsApp Belum Tersedia</a>
                @else
                <a href="{{ route('member.grupchat.join.wa') }}" class="btn btn-default btn-md"><img src="{{ asset('asset-beagle/img/whatsapp.png') }}" style="width: 20px; margin-right: 5px"> Join Grup WhatsApp</a>
                @endif
            </div>
            @else
            <div class="panel-body">
                <label for="" style="display: flex;" ><img src="{{ asset('asset-beagle/img/whatsapp.png') }}" style="width: 20px; margin-right: 5px"> WhatsApp</label>
                Link : <a href="{{ $wa->grupChat->link }}" class="text-bold">{{ $wa->grupChat->nama }}</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
